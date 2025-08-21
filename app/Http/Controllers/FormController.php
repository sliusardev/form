<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormRequest;
use App\Http\Requests\UpdateFormRequest;
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
            ->withCount('submissions')
            ->paginate(18);

        return view('dashboard.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('dashboard.forms.create');
    }

    public function store(StoreFormRequest $request)
    {
        $form = Form::query()->create($request->validated());

        return redirect()->route('forms.edit', $form)->with('success', __('dashboard.form_created'));
    }

    public function edit(Form $form)
    {
        // Check if the form belongs to the selected company
        if ($form->company_id !== selectedCompanyId()) {
            abort(403);
        }

        return view('dashboard.forms.edit', compact('form'));
    }

    public function update(UpdateFormRequest $request, Form $form)
    {
        $form->update($request->validated());

        return redirect()->route('forms.index')
            ->with('success', __('dashboard.form_updated'));
    }

    public function destroy(Form $form)
    {

    }
}
