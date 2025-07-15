<?php

namespace App\Http\Controllers;

use App\Models\BillingPlan;
use App\Models\Subscription;
use App\Services\LiqPayService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(BillingPlan $plan, LiqPayService $liqPayService)
    {
        // Check if user already has an active subscription
        $activeSubscription = Subscription::query()->where('company_id', selectedCompanyId())
            ->where('status', 'active')
            ->where('current_period_ends_at', '>', now())
            ->first();

        if ($activeSubscription) {
            return redirect()->route('my-subscription')
                ->with('warning', 'You already have an active subscription.');
        }

        $orderId = 'order_' . auth()->id() . '_' . time();

        // Create pending subscription
        $subscription = Subscription::query()->create([
            'user_id' => auth()->id(),
            'billing_plan_id' => $plan->id,
            'status' => 'pending',
            'starts_at' => now(),
            'current_period_ends_at' => now()->addMonth(),
            'liqpay_order_id' => $orderId,
            'auto_renew' => true,
            'company_id' => selectedCompanyId()
        ]);

        $paymentData = $liqPayService->generatePaymentData($subscription);

        return view('dashboard.payment.checkout', [
            'plan' => $plan,
            'subscription' => $subscription,
            'data' => $paymentData['data'],
            'signature' => $paymentData['signature']
        ]);
    }

    public function mySubscription()
    {
        $subscription = Subscription::query()->where('company_id', selectedCompanyId())
            ->with('billingPlan')
            ->where(function($query) {
                $query->where('status', 'active')
                    ->where('current_period_ends_at', '>', now());
            })
            ->orderBy('created_at', 'desc')
            ->first();

        return view('dashboard.subscriptions.my', compact('subscription'));
    }

    public function cancel(LiqPayService $liqPayService)
    {
        $subscription = Subscription::query()->where('company_id', selectedCompanyId())->first();

        if ($subscription && $subscription->isActive()) {
            // Set auto_renew to false
            $subscription->auto_renew = false;
            $subscription->status = 'canceled';

            // Set expires_at to current_period_ends_at
            $subscription->expires_at = $subscription->current_period_ends_at;

            // If you need to call LiqPay API to cancel subscription on their side
            // You could add that logic here or in a service class

            $subscription->save();

            $liqPayService->cancelSubscription($subscription);

            return redirect()->route('my-subscription')
                ->with('success', 'Your subscription has been canceled. You will have access until the end of your billing period.');
        }

        return redirect()->route('my-subscription')
            ->with('error', 'No active subscription found.');
    }
}
