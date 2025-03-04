<?php

namespace Mojahid\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Mojahid\Ecommerce\Enums\PaymentStatus;

class PaymentHistory extends Model
{
    protected $fillable = [
        'shop_id',
        'transaction_id',
        'method',
        'status',
        'agreement_id',
        'payer_id',
        'payer_email',
        'amount',
        'metadata',
        'processed_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'processed_at' => 'datetime',
        'status' => PaymentStatus::class
    ];

    public static function createHistory(array $data): self
    {
        $history = new self();
        $history->fill($data);
        $history->status = PaymentStatus::PENDING;
        $history->transaction_id = $data['transaction_id'] ?? uniqid('txn_', true);
        $history->save();

        return $history;
    }

    public function updateStatus(PaymentStatus $status): void
    {
        $this->status = $status;
        $this->processed_at = $status->isSuccess() ? now() : null;
        $this->save();
    }
}