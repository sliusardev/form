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
    ];

    protected $casts = [
        'payload' => 'array',
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
}
