<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActionCatalogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string','max:50','unique:actions_catalog,name'],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'], //Si agregaste este flag en la tabla
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
