<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataSourceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:80','unique:data_sources,name'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
