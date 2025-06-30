<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $settings = Setting::query()->where('user_id', auth()->user()->id)->first(); // Fetch the first settings record
        return view('dashboard.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::query()->firstOrNew(['user_id' => auth()->user()->id]);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                'unique:settings,company_slug,' . $settings->id . ',id,user_id,' . auth()->user()->id
            ],
            'data' => 'nullable|array',
        ]);

        $settings->fill($validated);
        $settings->user_id = auth()->user()->id;
        $settings->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }
}
