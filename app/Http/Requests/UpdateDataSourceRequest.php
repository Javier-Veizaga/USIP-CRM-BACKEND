<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDataSourceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('data_source'); // apiResource binding

        return [
            'name' => ['sometimes','string','max:80', Rule::unique('data_sources','name')->ignore($id)],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
