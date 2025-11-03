<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:30', 'unique:roles,code'],
            'name' => ['required', 'string', 'max:50'],
        ];
    }

    public function prepareForValidation(): void 
    {
        if ($this->has('code')) $this->merge(['code' => strtolower(trim($this->code))]);
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
