<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display the company page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $company = Company::query()->where('user_id', auth()->user()->id)->first(); // Fetch the first company record
        return view('dashboard.company', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Company::query()->firstOrNew(['user_id' => auth()->user()->id]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/',
                'unique:companies,slug,' . $company->id . ',id,user_id,' . auth()->user()->id
            ],
            'data' => 'nullable|array',
        ]);

        $company->fill($validated);
        $company->user_id = auth()->user()->id;
        $company->save();

        return redirect()->back()->with('success', 'Updated successfully.');
    }
}
