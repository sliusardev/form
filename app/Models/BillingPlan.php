<?php

namespace App\Models;

use App\Enums\BillingCycleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class BillingPlan extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price',
        'billing_cycle', 'features', 'is_active'
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public function getBillingPeriodInDays(): Carbon
    {
        return $this->billing_cycle === BillingCycleEnum::MONTHLY->value ? now()->addMonth(1) : now()->addYears(1);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'billing_plan_id');
    }
}
