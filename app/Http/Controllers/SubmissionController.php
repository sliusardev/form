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

    public function store(StoreSubmissionRequest $request, SubmissionService $submissionService)
    {
        /** @var Form|null $form */
        $form = $request->attributes->get('form');
        if (!$form) {
            return response()->json([
                'status' => 'error_not_found',
                'text' => 'Form not found.',
            ], 404);
        }

        $origin = $request->attributes->get('origin');
        $referer = $request->attributes->get('referer');
        $userAgent = $request->attributes->get('user_agent');

        // Already validated by StoreSubmissionRequest
        $formData = $request->validated();

        $submission = $submissionService->createSubmission(
            $form,
            $formData,
            $request->ip(),
            $request->getMethod(),
            $userAgent,
            $origin,
            $referer
        );

        $message = 'Your submission has been successfully received.';

        if ($referer) {
            // HTML (embedded form) flow
            return view('answers.success', [
                'text' => $message,
                'redirect' => $referer,
            ]);
        }

        // API / AJAX flow
        return response()->json([
            'success' => true,
            'message' => $message,
            'submission_id' => $submission->id,
        ], 201);
    }

}
