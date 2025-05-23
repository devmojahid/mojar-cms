<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Exceptions;

class FileManagerException extends \Exception
{
    /**
     * @param array $errors
     */
    public function __construct($errors)
    {
        parent::__construct(implode("\n", $errors));
    }
}
