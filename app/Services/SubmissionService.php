<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;
use Str;

class SubmissionService
{
    public function createSubmission(Form $form, array $formData, string $ipAddress, string $method): Submission
    {
        $submission = Submission::query()->create([
            'form_id' => $form->id,
            'payload' => $formData,
            'ip_address' => $ipAddress,
            'company_id' => $form->company_id,
            'status' => 'success',
            'hash' => Str::random(20),
            'method' => $method
        ]);

        // Update the submission count for the company
        $form->company->decrement('submission_limit');
        $form->company->save();

        // Optionally, send notifications or perform other actions here

        return $submission;
    }
}
