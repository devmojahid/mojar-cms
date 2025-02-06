<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     Mojahid
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Abstracts;

use Juzaweb\CMS\Traits\Loggers\PaymentLogger;
use Juzaweb\CMS\Traits\TransactionManager;
use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Juzaweb\CMS\Exceptions\PaymentException;

/**
 * @method void beforeFinish()
 * @method void afterFinish()
 * @method void afterUpdateFileAndFolder()
 */
abstract class PaymentMethodAbstract implements PaymentMethodInterface
{
    use PaymentLogger, TransactionManager;


    protected PaymentMethod $paymentMethod;


    protected bool $redirect = false;
    protected bool $successful = false;
    protected string $redirectURL = '';
    protected string $message = '';
    protected array $errors = [];
    protected PaymentStatus $status;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        $this->status = PaymentStatus::PENDING;
    }

    abstract public function purchase(array $params): PaymentMethodInterface;

    abstract public function completed(array $params): PaymentMethodInterface;

    public function isRedirect(): bool
    {
        return $this->redirect;
    }

    public function getRedirectURL(): null|string
    {
        if ($this->isRedirect()) {
            return $this->redirectURL;
        }

        return null;
    }
    public function getMessage(): string
    {
        return $this->message ?: __('Thank you for your order.');
    }


    protected function setRedirectURL(string $url): void
    {
        $this->redirectURL = $url;
    }

    protected function setRedirect(bool $redirect): void
    {
        $this->redirect = $redirect;
    }

    protected function setSuccessful(bool $successful): void
    {
        $this->successful = $successful;
    }

    protected function setMessage(string $message): void

    {
        $this->message = $message;
    }

    protected function processPurchase(array $params): PaymentMethodInterface
    {
        try {
            $this->beginTransaction();
            $this->validatePurchase($params);
            $result = $this->purchase($params);

            $this->commitTransaction();
            return $result;
        } catch (\Exception $e) {
            $this->status = PaymentStatus::FAILED;
            $this->rollbackTransaction();
            $this->logError('Purchase failed', [
                'params' => $params,
                'error' => $e->getMessage()
            ]);
            throw new PaymentException($e->getMessage(), $this->errors, $this->currentTransactionId);
        }
    }

    protected function validatePurchase(array $params): void
    {
        if (empty($params['amount']) || !is_numeric($params['amount'])) {
            throw new PaymentException('Invalid amount');
        }

        if ($params['amount'] <= 0) {
            throw new PaymentException('Amount must be greater than 0');
        }

        // Add more validation as needed
    }

    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    protected function addError(string $message): void
    {
        $this->errors[] = $message;
    }
}
