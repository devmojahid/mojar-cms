<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Support;

class JSMin
{
    public const ORD_LF = 10;
    public const ORD_SPACE = 32;
    public const ACTION_KEEP_A = 1;
    public const ACTION_DELETE_A = 2;
    public const ACTION_DELETE_A_B = 3;

    protected $a = "\n";
    protected $b = '';
    protected $input = '';
    protected $inputIndex = 0;
    protected $inputLength = 0;
    protected $lookAhead = null;
    protected $output = '';
    protected $lastByteOut = '';
    protected $keptComment = '';

    /**
     * Minify Javascript.
     *
     * @param string $js Javascript to be minified
     *
     * @return string
     */
    public static function minify($js)
    {
        $jsmin = new JSMin($js);

        return $jsmin->min();
    }

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Perform minification, return result
     *
     * @return string
     */
    public function min()
    {
        if ($this->output !== '') { // min already run
            return $this->output;
        }

        $mbIntEnc = null;
        if (function_exists('mb_strlen') && ((int)ini_get('mbstring.func_overload') & 2)) {
            $mbIntEnc = mb_internal_encoding();
            mb_internal_encoding('8bit');
        }

        if (isset($this->input[0]) && $this->input[0] === "\xef") {
            $this->input = substr($this->input, 3);
        }

        $this->input = str_replace("\r\n", "\n", $this->input);
        $this->inputLength = strlen($this->input);

        $this->action(self::ACTION_DELETE_A_B);

        while ($this->a !== null) {
            // determine next command
            $command = self::ACTION_KEEP_A; // default
            if ($this->a === ' ') {
                if (($this->lastByteOut === '+' || $this->lastByteOut === '-')
                    && ($this->b === $this->lastByteOut)
                ) {
                    // Don't delete this space. If we do, the addition/subtraction
                    // could be parsed as a post-increment
                } elseif (! $this->isAlphaNum($this->b)) {
                    $command = self::ACTION_DELETE_A;
                }
            } elseif ($this->a === "\n") {
                if ($this->b === ' ') {
                    $command = self::ACTION_DELETE_A_B;

                    // in case of mbstring.func_overload & 2, must check for null b,
                    // otherwise mb_strpos will give WARNING
                } elseif (
                    $this->b === null
                    || (false === strpos('{[(+-!~', $this->b)
                        && ! $this->isAlphaNum($this->b))
                ) {
                    $command = self::ACTION_DELETE_A;
                }
            } elseif (! $this->isAlphaNum($this->a)) {
                if (
                    $this->b === ' '
                    || ($this->b === "\n"
                        && (false === strpos('}])+-"\'', $this->a)))
                ) {
                    $command = self::ACTION_DELETE_A_B;
                }
            }
            $this->action($command);
        }
        $this->output = trim($this->output);

        if ($mbIntEnc !== null) {
            mb_internal_encoding($mbIntEnc);
        }

        return $this->output;
    }

    /**
     * ACTION_KEEP_A = Output A. Copy B to A. Get the next B.
     * ACTION_DELETE_A = Copy B to A. Get the next B.
     * ACTION_DELETE_A_B = Get the next B.
     *
     * @param int $command
     * @throws UnterminatedRegExpException|UnterminatedStringException
     */
    protected function action($command)
    {
        // make sure we don't compress "a + ++b" to "a+++b", etc.
        if (
            $command === self::ACTION_DELETE_A_B
            && $this->b === ' '
            && ($this->a === '+' || $this->a === '-')
        ) {
            // Note: we're at an addition/substraction operator; the inputIndex
            // will certainly be a valid index
            if ($this->input[$this->inputIndex] === $this->a) {
                // This is "+ +" or "- -". Don't delete the space.
                $command = self::ACTION_KEEP_A;
            }
        }

        switch ($command) {
            case self::ACTION_KEEP_A: // 1
                $this->output .= $this->a;

                if ($this->keptComment) {
                    $this->output = rtrim($this->output, "\n");
                    $this->output .= $this->keptComment;
                    $this->keptComment = '';
                }

                $this->lastByteOut = $this->a;

                // fallthrough intentional
                // no break
            case self::ACTION_DELETE_A: // 2
                $this->a = $this->b;
                if ($this->a === "'" || $this->a === '"' || $this->a === '`') { // string/template literal
                    $delimiter = $this->a;
                    $str = $this->a; // in case needed for exception
                    for (;;) {
                        $this->output .= $this->a;
                        $this->lastByteOut = $this->a;

                        $this->a = $this->get();
                        if ($this->a === $this->b) { // end quote
                            break;
                        }
                        if ($delimiter === '`' && $this->a === "\n") {
                            // leave the newline
                        } elseif ($this->isEOF($this->a)) {
                            $byte = $this->inputIndex - 1;

                            throw new UnterminatedStringException(
                                "JSMin: Unterminated String at byte {$byte}: {$str}"
                            );
                        }
                        $str .= $this->a;
                        if ($this->a === '\\') {
                            $this->output .= $this->a;
                            $this->lastByteOut = $this->a;

                            $this->a = $this->get();
                            $str .= $this->a;
                        }
                    }
                }

                // fallthrough intentional
                // no break
            case self::ACTION_DELETE_A_B: // 3
                $this->b = $this->next();
                if ($this->b === '/' && $this->isRegexpLiteral()) {
                    $this->output .= $this->a . $this->b;
                    $pattern = '/'; // keep entire pattern in case we need to report it in the exception
                    for (;;) {
                        $this->a = $this->get();
                        $pattern .= $this->a;
                        if ($this->a === '[') {
                            for (;;) {
                                $this->output .= $this->a;
                                $this->a = $this->get();
                                $pattern .= $this->a;
                                if ($this->a === ']') {
                                    break;
                                }
                                if ($this->a === '\\') {
                                    $this->output .= $this->a;
                                    $this->a = $this->get();
                                    $pattern .= $this->a;
                                }
                                if ($this->isEOF($this->a)) {
                                    throw new UnterminatedRegExpException(
                                        "JSMin: Unterminated set in RegExp at byte "
                                            . $this->inputIndex . ": {$pattern}"
                                    );
                                }
                            }
                        }

                        if ($this->a === '/') { // end pattern
                            break; // while (true)
                        } elseif ($this->a === '\\') {
                            $this->output .= $this->a;
                            $this->a = $this->get();
                            $pattern .= $this->a;
                        } elseif ($this->isEOF($this->a)) {
                            $byte = $this->inputIndex - 1;

                            throw new UnterminatedRegExpException(
                                "JSMin: Unterminated RegExp at byte {$byte}: {$pattern}"
                            );
                        }
                        $this->output .= $this->a;
                        $this->lastByteOut = $this->a;
                    }
                    $this->b = $this->next();
                }
                // end case ACTION_DELETE_A_B
        }
    }

    /**
     * @return bool
     */
    protected function isRegexpLiteral()
    {
        if (false !== strpos("(,=:[!&|?+-~*{;", $this->a)) {
            // we can't divide after these tokens
            return true;
        }

        // check if first non-ws token is "/" (see starts-regex.js)
        $length = strlen($this->output);
        if ($this->a === ' ' || $this->a === "\n") {
            if ($length < 2) { // weird edge case
                return true;
            }
        }

        // if the "/" follows a keyword, it must be a regexp, otherwise it's best to assume division

        $subject = $this->output . trim($this->a);
        if (! preg_match('/(?:case|else|in|return|typeof)$/', $subject, $m)) {
            // not a keyword
            return false;
        }

        // can't be sure it's a keyword yet (see not-regexp.js)
        $charBeforeKeyword = substr($subject, 0 - strlen($m[0]) - 1, 1);
        if ($this->isAlphaNum($charBeforeKeyword)) {
            // this is really an identifier ending in a keyword, e.g. "xreturn"
            return false;
        }

        // it's a regexp. Remove unneeded whitespace after keyword
        if ($this->a === ' ' || $this->a === "\n") {
            $this->a = '';
        }

        return true;
    }

    /**
     * Return the next character from stdin. Watch out for lookahead. If the character is a control character,
     * translate it to a space or linefeed.
     *
     * @return string
     */
    protected function get()
    {
        $c = $this->lookAhead;
        $this->lookAhead = null;
        if ($c === null) {
            // getc(stdin)
            if ($this->inputIndex < $this->inputLength) {
                $c = $this->input[$this->inputIndex];
                $this->inputIndex += 1;
            } else {
                $c = null;
            }
        }
        if (ord($c) >= self::ORD_SPACE || $c === "\n" || $c === null) {
            return $c;
        }
        if ($c === "\r") {
            return "\n";
        }

        return ' ';
    }

    /**
     * Does $a indicate end of input?
     *
     * @param string $a
     * @return bool
     */
    protected function isEOF($a)
    {
        return ord($a) <= self::ORD_LF;
    }

    /**
     * Get next char (without getting it). If is ctrl character, translate to a space or newline.
     *
     * @return string
     */
    protected function peek()
    {
        $this->lookAhead = $this->get();

        return $this->lookAhead;
    }

    /**
     * Return true if the character is a letter, digit, underscore, dollar sign, or non-ASCII character.
     *
     * @param string $c
     *
     * @return bool
     */
    protected function isAlphaNum($c)
    {
        return (preg_match('/^[a-z0-9A-Z_\\$\\\\]$/', $c) || ord($c) > 126);
    }

    /**
     * Consume a single line comment from input (possibly retaining it)
     */
    protected function consumeSingleLineComment()
    {
        $comment = '';
        while (true) {
            $get = $this->get();
            $comment .= $get;
            if (ord($get) <= self::ORD_LF) { // end of line reached
                // if IE conditional comment
                if (preg_match('/^\\/@(?:cc_on|if|elif|else|end)\\b/', $comment)) {
                    $this->keptComment .= "/{$comment}";
                }

                return;
            }
        }
    }

    /**
     * Consume a multiple line comment from input (possibly retaining it)
     *
     * @throws UnterminatedCommentException
     */
    protected function consumeMultipleLineComment()
    {
        $this->get();
        $comment = '';
        for (;;) {
            $get = $this->get();
            if ($get === '*') {
                if ($this->peek() === '/') { // end of comment reached
                    $this->get();
                    if (0 === strpos($comment, '!')) {
                        // preserved by YUI Compressor
                        if (! $this->keptComment) {
                            // don't prepend a newline if two comments right after one another
                            $this->keptComment = "\n";
                        }
                        $this->keptComment .= "/*!" . substr($comment, 1) . "*/\n";
                    } elseif (preg_match('/^@(?:cc_on|if|elif|else|end)\\b/', $comment)) {
                        // IE conditional
                        $this->keptComment .= "/*{$comment}*/";
                    }

                    return;
                }
            } elseif ($get === null) {
                throw new UnterminatedCommentException(
                    "JSMin: Unterminated comment at byte {$this->inputIndex}: /*{$comment}"
                );
            }
            $comment .= $get;
        }
    }

    /**
     * Get the next character, skipping over comments. Some comments may be preserved.
     *
     * @return string
     */
    protected function next()
    {
        $get = $this->get();
        if ($get === '/') {
            switch ($this->peek()) {
                case '/':
                    $this->consumeSingleLineComment();
                    $get = "\n";

                    break;
                case '*':
                    $this->consumeMultipleLineComment();
                    $get = ' ';

                    break;
            }
        }

        return $get;
    }
}
