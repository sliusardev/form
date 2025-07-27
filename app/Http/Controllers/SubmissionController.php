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
       $view = $request->input('view', $request->cookie('submissions_view_preference', 'table'));

       if ($request->has('view')) {
           Cookie::queue('submissions_view_preference', $view, 43200); // 30 days
       }

       $companyId = selectedCompanyId();

       $submissions = Submission::query()
           ->where('company_id', $companyId)
           ->with('form:id,title')
           ->when($request->filled('form_id'), function ($query) use ($request) {
               $query->where('form_id', $request->form_id);
           })
           ->latest()
           ->paginate(20);

       $forms = Form::query()
           ->where('company_id', $companyId)
           ->orderBy('title')
           ->select('title', 'id')
           ->get();

       return view('dashboard.submissions.index', compact('submissions', 'forms', 'view'));
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
        // Get the form from the request attributes (set by the middleware)
        $form = $request->attributes->get('form');

        // If the form is not in the request attributes, load it (fallback)
        if (!$form) {
            $form = Form::query()
                ->where('hash', $hash)
                ->where('is_enabled', true)
                ->with('company')
                ->first();

            if (!$form) {
                return response()->json([
                    'status' => 'form_not_found',
                    'data' => [],
                ], 404);
            }
        } else {
            // Ensure company relationship is loaded
            $form->load('company');
        }

        if ($form->company->submission_limit === 0) {
            return response()->json([
                'status' => 'submission_limit_reached',
                'data' => [],
            ], 403);
        }

        // Use validated data instead of all request data
        $formData = $request->validated();

        // If the request is JSON, merge the validated data with JSON data
        if ($request->isJson()) {
            $jsonData = $request->json()->all();
            $validator = validator($jsonData, $request->rules());

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'validation_error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $formData = $validator->validated();
        }

        // Merge GET params with validated data
        $allData = array_merge($formData, $request->query());

        $submission = $submissionService->createSubmission(
            $form,
            $allData,
            $request->ip(),
            $request->getMethod()
        );

        return response()->json([
            'success' => true,
            'message' => 'Submission successful',
            'submission_id' => $submission->id,
        ]);
    }
}
