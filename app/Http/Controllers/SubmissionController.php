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

    public function store(Request $request, string $hash, SubmissionService $submissionService)
    {
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

        if ($form->company->submission_limit === 0) {
            return response()->json([
                'status' => 'submission_limit_reached',
                'data' => [],
            ], 403);
        }

        $formData = $request->all();

        // Check if we have a JSON string as a key (the WayForPay response pattern)
        if (is_array($formData) && count($formData) === 1) {
            $keys = array_keys($formData);
            $firstKey = reset($keys);

            // Check if the first key looks like a JSON string
            if (is_string($firstKey) && str_starts_with($firstKey, '{')) {
                try {
                    // First, replace escaped quotes with actual quotes
                    $jsonString = str_replace('\"', '"', $firstKey);
                    // Also fix the underscores in decimal numbers like 0_02 to 0.02
                    $jsonString = preg_replace('/_(\d+)/', '.\1', $jsonString);
                    // Also fix underscores in text like JSC_UNIVERSAL_BANK
                    $jsonString = str_replace('_', ' ', $jsonString);

                    // Now decode the JSON string
                    $decodedData = json_decode($jsonString, true);

                    if (json_last_error() === JSON_ERROR_NONE && is_array($decodedData)) {
                        $formData = $decodedData;
                    }
                } catch (\Exception $e) {
                    // If decoding fails, keep original data
                    \Log::error('Failed to parse payment data: ' . $e->getMessage());
                }
            }
        } elseif ($request->isJson()) {
            $formData = $request->json()->all();
        }


        if ($request->isJson()) {
            $formData = $request->json()->all();
        }

        $submission = $submissionService->createSubmission(
            $form,
            $formData,
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
