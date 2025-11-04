<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAgreementStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('agreement_status');

        return [
            'name'        => ['sometimes','string','max:30', Rule::unique('agreement_statuses','name')->ignore($id)],
            'description' => ['sometimes','nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
