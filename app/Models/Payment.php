<?php

namespace App\Models;

use App\Enums\PaymentProviderEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'payload' => 'array',
        'status' => PaymentStatusEnum::class,
        'provider' => PaymentProviderEnum::class,
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }
}
