<?php

namespace App\Http\Controllers;

use App\Enums\CurrenciesEnum;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Settings::query()->firstOrCreate();
        $settings = $setting->data ?? [];

        $currencies = CurrenciesEnum::all();

        return view('dashboard.settings', [
            'settings' => $settings,
            'currencies' => $currencies,
        ]);
    }

    public function update(Request $request)
    {
        $settings = Settings::query()->first();

        $data = $request->except(['_token', '_method']);

        $settings->update([
           'data' => $data
        ]);

        return redirect()->back()->with('success', __('dashboard.settings_updated'));
    }

    public function artisanActions(Request $request)
    {
        $action = $request->input('action');

        if (!$action) {
            return redirect()->back()->with('error', 'No action specified.');
        }

        if ($action == 'optimize:clear') {
            Artisan::call('optimize:clear');
            return redirect()->back()->with('success', __('dashboard.cache_cleared'));
        }

        if ($action == 'migrate') {
            Artisan::call('migrate', ['--force' => true]);
            return redirect()->back()->with('success', __('dashboard.database_migrated'));
        }

        return redirect()->back()->with('error', 'No such action found.');
    }

}
