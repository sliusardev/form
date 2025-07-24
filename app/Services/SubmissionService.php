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
        // Sanitize form data to prevent XSS attacks
        $sanitizedData = $this->sanitizeFormData($formData);

        $submission = Submission::query()->create([
            'form_id' => $form->id,
            'payload' => $sanitizedData,
            'ip_address' => $ipAddress,
            'company_id' => $form->company_id,
            'status' => 'success',
            'hash' => Str::random(20),
            'method' => $method
        ]);

        // Update the submission count for the company
        // Ensure submission_limit doesn't go below zero
        if ($form->company->submission_limit > 0) {
            $form->company->decrement('submission_limit');
            $form->company->save();
        }

        // Optionally, send notifications or perform other actions here

        return $submission;
    }

    /**
     * Recursively sanitize form data to prevent XSS attacks
     *
     * @param array $data
     * @return array
     */
    private function sanitizeFormData(array $data): array
    {
        $sanitized = [];

        foreach ($data as $key => $value) {
            // Sanitize the key
            $sanitizedKey = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');

            if (is_array($value)) {
                // Recursively sanitize nested arrays
                $sanitized[$sanitizedKey] = $this->sanitizeFormData($value);
            } else if (is_string($value)) {
                // Sanitize string values
                $sanitized[$sanitizedKey] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            } else {
                // Keep other types as is (numbers, booleans, null)
                $sanitized[$sanitizedKey] = $value;
            }
        }

        return $sanitized;
    }
}
