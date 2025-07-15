<?php

        namespace App\Http\Controllers;

        use App\Models\BillingPlan;
        use Illuminate\Http\Request;
        use Illuminate\Support\Str;

        class BillingPlanController extends Controller
        {
            public function index()
            {
                $plans = BillingPlan::query()->where('is_active', true)->get();
                return view('dashboard.billing-plans.index', compact('plans'));
            }

            public function show(BillingPlan $plan)
            {
                return view('dashboard.billing-plans.show', compact('plan'));
            }

            public function create()
            {
                return view('dashboard.billing-plans.create');
            }

            public function store(Request $request)
            {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'price' => 'required|numeric|min:0',
                    'billing_cycle' => 'required|in:monthly,yearly',
                    'features' => 'required|array',
                    'features.*' => 'string',
                    'is_active' => 'boolean',
                ]);

                $validated['slug'] = Str::slug($validated['name']);
                $validated['is_active'] = $request->has('is_active');

                BillingPlan::query()->create($validated);

                return redirect()->route('billing-plans.index')
                    ->with('success', 'Billing plan created successfully.');
            }

            public function edit(BillingPlan $plan)
            {
                return view('dashboard.billing-plans.edit', compact('plan'));
            }

            public function update(Request $request, BillingPlan $plan)
            {
                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                    'price' => 'required|numeric|min:0',
                    'billing_cycle' => 'required|in:monthly,yearly',
                    'features' => 'required|array',
                    'features.*' => 'string',
                    'is_active' => 'boolean',
                ]);

                $validated['slug'] = Str::slug($validated['name']);
                $validated['is_active'] = $request->has('is_active');

                $plan->update($validated);

                return redirect()->route('billing-plans.index')
                    ->with('success', 'Billing plan updated successfully.');
            }

            public function destroy(BillingPlan $plan)
            {
                $plan->delete();

                return redirect()->route('billing-plans.index')
                    ->with('success', 'Billing plan deleted successfully.');
            }
        }
