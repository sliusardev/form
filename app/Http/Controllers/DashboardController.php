<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $companyId = selectedCompanyId();

        $formsQb = Form::query()->where('company_id', $companyId)->get();
        $formsCount = $formsQb->count();
        $activeFormsCount = $formsQb->where('is_enabled', true)->count();

        return view('dashboard.index', compact('activeFormsCount', 'formsCount'));
    }
}
