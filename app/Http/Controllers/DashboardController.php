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

        // Get submissions data for chart
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $dailySubmissions = Submission::query()
            ->where('company_id', $companyId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Prepare chart data
        $labels = [];
        $counts = [];

        for ($day = 0; $day < 7; $day++) {
            $date = $startOfWeek->copy()->addDays($day)->format('Y-m-d');
            $labels[] = $startOfWeek->copy()->addDays($day)->format('D');
            $counts[] = $dailySubmissions->get($date, 0);
        }

        return view('dashboard.index', compact(
            'activeFormsCount',
            'formsCount',
            'submissionsCount',
            'submissionsThisWeekCount',
            'labels',
            'counts'
        ));
    }
}
