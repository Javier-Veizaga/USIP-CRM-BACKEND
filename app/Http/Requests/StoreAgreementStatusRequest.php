<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgreementStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'        => ['required','string','max:30','unique:agreement_statuses,name'],
            'description' => ['nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
