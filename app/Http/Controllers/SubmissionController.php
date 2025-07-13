<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\Form;
use App\Models\Submission;
use App\Services\SubmissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Str;

class SubmissionController extends Controller
{
   public function index(Request $request)
   {
       if ($request->has('view')) {
           $view = $request->input('view');
           Cookie::queue('submissions_view_preference', $view, 43200); // Cookie lasts 30 days
       } else {
           // If no view parameter, check for cookie and redirect if exists
           $view = $request->cookie('submissions_view_preference', 'table');
           if ($view) {
               return redirect()->route('submissions.index', ['view' => $view]);
           }
       }

       $companyId = selectedCompanyId();

       $query = Submission::query()
           ->where('company_id', $companyId)
           ->with(['form'])
           ->orderBy('created_at', 'desc');

       // Apply form filter if provided
       if ($request->has('form_id') && $request->form_id) {
           $query->where('form_id', $request->form_id);
       }

       $submissions = $query->paginate(20);

       // Get all forms for the dropdown
       $forms = Form::query()->where('company_id', $companyId)
           ->orderBy('title')
           ->get(['id', 'title']);

       return view('dashboard.submissions.index', compact('submissions', 'forms'));
   }

    public function show(Submission $submission)
    {
        // Check if submission belongs to the company
        if ($submission->company_id != session('company_id')) {
            abort(403);
        }

        $submission = Submission::query()
            ->where('id', $submission->id)
            ->with(['form'])
            ->first();

        return view('dashboard.submissions.detail', compact('submission'));
    }

    public function formSubmissions(Form $form)
    {

    }

    public function store(StoreSubmissionRequest $request, string $hash, SubmissionService $submissionService)
    {
        $form = $request->form; // Added by middleware
        $formData = $request->validated();

        $submission = $submissionService->createSubmission(
            $form,
            $formData,
            $request->ip()
        );

        return response()->json([
            'success' => true,
            'message' => 'Submission successful',
            'submission_id' => $submission->id,
        ]);
    }
}
