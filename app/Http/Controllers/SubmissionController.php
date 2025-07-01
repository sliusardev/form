<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function submissions()
    {
        return view('dashboard.submissions');
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
        ]);

        // Optionally, send notifications or perform other actions

        return response()->json([
            'success' => true,
            'message' => 'Submission successful',
            'submission_id' => $submission->id,
        ]);

    }
}
