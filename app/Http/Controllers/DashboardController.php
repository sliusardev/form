<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $companyId = selectedCompanyId();

        $forms = Form::query()
            ->where('company_id', $companyId)
            ->select('id', 'is_enabled')
            ->get();

        $formsCount = $forms->count();
        $activeFormsCount = $forms->where('is_enabled', true)->count();


        $submissions = Submission::query()
            ->where('company_id', $companyId)
            ->select('id', 'created_at')
            ->get();

        $submissionsCount = $submissions->count();
        $submissionsThisWeekCount = $submissions->where('created_at', '>=', now()->startOfWeek())->count();

        return view('dashboard.index', compact(
            'activeFormsCount',
            'formsCount',
            'submissionsCount',
            'submissionsThisWeekCount'
        ));
    }
}
