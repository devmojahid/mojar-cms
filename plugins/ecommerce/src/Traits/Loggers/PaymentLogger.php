<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     Mojahid
 * @link       https://mojar.com
 * @license    GNU V2
 */

namespace Mojahid\Ecommerce\Traits\Loggers;

use Illuminate\Support\Facades\Log;

trait PaymentLogger

{
    protected function logPayment(string $level, string $message, array $context = []): void
    {
        $baseContext = [
            'payment_method' => $this->paymentMethod->type ?? 'unknown',
            'transaction_id' => $this->currentTransactionId ?? null,
            'payment_id' => $this->paymentMethod->id ?? null,
        ];

        $context = array_merge($baseContext, $context);

        Log::channel('payments')->{$level}($message, $context);
    }

    protected function logError(string $message, array $context = [], ?\Throwable $exception = null): void
    {
        if ($exception) {
            $context['exception'] = [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString()
            ];
        }
        $this->logPayment('error', $message, $context);
    }

    protected function logInfo(string $message, array $context = []): void
    {
        $this->logPayment('info', $message, $context);
    }

    protected function logWarning(string $message, array $context = []): void
    {
        $this->logPayment('warning', $message, $context);
    }
}