<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display the company page.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $company = Company::query()
            ->where('id', selectedCompanyId())
            ->with(['payments'])
            ->first(); // Fetch the first company record


        return view('dashboard.company', compact('company'));
    }

public function update(UpdateCompanyRequest $request)
{
    $company = Company::query()->firstOrNew(['user_id' => selectedCompanyId()]);

    $company->fill($request->validated());
    $company->user_id = auth()->user()->id;
    $company->save();

    return redirect()->back()->with('success', 'Updated successfully.');
}
}
