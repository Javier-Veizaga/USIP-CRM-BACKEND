<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCourseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('course');

        return [
            'name'       => ['sometimes','string','max:50'],
            'semesters'  => ['sometimes','integer','min:1','max:20'],
            'faculty_id' => ['sometimes','integer','exists:faculties,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge(['name' => trim((string)$this->name)]);
        }
    }
}
