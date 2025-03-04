<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     Mojahid
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojahid\Ecommerce\Exceptions;

use Exception;

class PaymentException extends Exception {
    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * @var string|null
     */
    protected ?string $transactionId = null;
    protected array $context = [];

    public function __construct(
        string $message,
        array $errors = [],
        ?string $transactionId = null,
        array $context = [],
        int $code = 0
    ) {
        parent::__construct($message, $code);
        $this->errors = $errors;
        $this->transactionId = $transactionId;
        $this->context = $context;
    }


    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}