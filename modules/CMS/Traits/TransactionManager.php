<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Traits;

use Juzaweb\CMS\Exceptions\PaymentException;
use Illuminate\Support\Facades\DB;

trait TransactionManager
{
    protected ?string $currentTransactionId = null;

    protected function generateTransactionId(): string
    {
        return uniqid('txn_', true) . '_' . time();
    }

    protected function beginTransaction(): string
    {
        try {
            $this->currentTransactionId = $this->generateTransactionId();
            DB::beginTransaction();
            
            $this->logInfo('Transaction started', [
                'transaction_id' => $this->currentTransactionId
            ]);
            
            return $this->currentTransactionId;
        } catch (\Throwable $e) {
            $this->logError('Failed to start transaction', [], $e);
            throw new PaymentException(
                'Transaction initialization failed',
                [],
                $this->currentTransactionId,
                ['original_error' => $e->getMessage()]
            );
        }
    }

    protected function commitTransaction(): void
    {
        try {
            DB::commit();
            $this->logInfo('Transaction committed successfully');
        } catch (\Throwable $e) {
            $this->logError('Failed to commit transaction', [], $e);
            $this->rollbackTransaction();
            throw new PaymentException(
                'Transaction commit failed',
                [],
                $this->currentTransactionId,
                ['original_error' => $e->getMessage()]
            );
        }
    }

    protected function rollbackTransaction(): void
    {
        try {
            DB::rollBack();
            $this->logInfo('Transaction rolled back');
        } catch (\Throwable $e) {
            $this->logError('Failed to rollback transaction', [], $e);
        }
    }
}
