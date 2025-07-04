<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;
use Str;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::query()
            ->where('company_id', session('company_id'))
            ->with(['form'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('dashboard.submissions.index', compact('submissions'));
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

    public function store(Request $request, string $hash)
    {
        // Validate the hash and find the form
        $form = Form::query()->where('hash', $hash)->firstOrFail();

        if(!$form) {
            return response()->json([
                'status' => 'form_not_found',
                'data' => [],
            ]);
        }

//        dd($request->all());

        // Validate the submission data
//        $validated = request()->validate($form->getValidationRules());

        $formData = $request->all();
        $submission = Submission::query()->create([
            'form_id' => $form->id,
            'payload' => $formData,
            'ip_address' => $request->ip(),
            'company_id' => $form->company_id,
            'status' => 'success',
            'hash' => Str::random(20)
        ]);

        // Optionally, send notifications or perform other actions

        return response()->json([
            'success' => true,
            'message' => 'Submission successful',
            'submission_id' => $submission->id,
        ]);

    }
}
