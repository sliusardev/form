<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Str;

class FormController extends Controller
{
    public function forms()
    {
        $forms = Form::query()
            ->where('company_id', selectedCompanyId())
            ->orderBy('created_at', 'desc')
            ->paginate(18);

        return view('dashboard.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('dashboard.forms.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    // Convert checkbox values properly
    $validated['is_enabled'] = $request->has('is_enabled');
    $validated['send_notify'] = $request->has('send_notify');
    $validated['company_id'] = selectedCompanyId();
    $validated['hash'] = Str::random(15);

    $form = Form::query()->create($validated);

    return redirect()->route('forms.edit', $form)->with('success', 'Form created successfully');
}

    public function edit(Form $form)
    {
        // Check if the form belongs to the selected company
        if ($form->company_id !== selectedCompanyId()) {
            abort(403);
        }

        return view('dashboard.forms.edit', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        // Check if the form belongs to the selected company
        if ($form->company_id !== selectedCompanyId()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Convert checkbox values properly
        $validated['is_enabled'] = $request->has('is_enabled');
        $validated['send_notify'] = $request->has('send_notify');

        $form->update($validated);

        return redirect()->route('forms.index')
            ->with('success', 'Form updated successfully');
    }

    public function destroy(Form $form)
    {

    }
}
