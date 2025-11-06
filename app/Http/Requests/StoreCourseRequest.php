<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'       => ['required','string','max:50'],
            'semesters'  => ['required','integer','min:1','max:20'],
            'faculty_id' => ['required','integer','exists:faculties,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge(['name' => trim((string)$this->name)]);
        }
    }
}
