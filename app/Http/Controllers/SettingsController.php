<?php

namespace App\Http\Controllers;

use App\Enums\CurrenciesEnum;
use App\Models\Settings;
use Illuminate\Http\Request;

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

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

}
