<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProspectStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'status_id'   => ['required','integer','exists:statuses,id'],
            'user_id'     => ['required','integer','exists:users,id'],
            'description' => ['nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('description')) {
            $this->merge(['description' => trim((string)$this->description)]);
        }
    }
}
