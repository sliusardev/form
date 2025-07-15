<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id', 'billing_plan_id', 'status',
        'starts_at', 'current_period_ends_at', 'expires_at',
        'liqpay_order_id', 'auto_renew',
        'company_id'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'current_period_ends_at' => 'datetime',
        'expires_at' => 'datetime',
        'auto_renew' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function billingPlan(): BelongsTo
    {
        return $this->belongsTo(BillingPlan::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && now()->lt($this->current_period_ends_at);
    }

    public function cancelSubscription(): void
    {
        $this->auto_renew = false;
        $this->expires_at = $this->current_period_ends_at;
        $this->save();
    }
}
