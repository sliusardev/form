<?php

namespace App\Models;

use App\Enums\PaymentProviderEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'provider',
        'payment_id',
        'amount',
        'currency',
        'status',
        'payload',
        'company_id',
        'user_id',
        'order',
    ];

    protected $casts = [
        'payload' => 'array',
        'order' => 'array',
        'status' => PaymentStatusEnum::class,
        'provider' => PaymentProviderEnum::class,
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPayloadJson(): false|string
    {
        return is_array($this->payload)
            ? json_encode($this->payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            : '';
    }

    public function getStatusColor(): string
    {

        return match($this->status) {
            PaymentStatusEnum::PAID => 'bg-green-100 text-green-800',
            PaymentStatusEnum::PENDING => 'bg-yellow-100 text-yellow-800',
            PaymentStatusEnum::REFUNDED => 'bg-sky-100 text-sky-800',
            PaymentStatusEnum::FAILED => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
