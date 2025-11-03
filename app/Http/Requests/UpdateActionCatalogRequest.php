<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActionCatalogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('action_catalog'); 
        return [
            'name' => ['sometimes', 'string', 'max:50', Rule::unique('actions_catalog', 'name')->ignore($id)],
            'description' => ['sometimes', 'nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function prepareForValidation(): void 
    {
        if($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
