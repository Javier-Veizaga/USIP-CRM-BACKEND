<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;//Ojasoooooo
    }

    public function rules(): array
    {
        $id = $this->route('role');// funciona con apiResource

        return [
            'code' => [
                'sometimes','string','max:30',
                Rule::unique('roles','code')->ignore($id),
            ],
            'name' => ['sometimes','string','max:50'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('code')) $this->merge(['code' => strtolower(trim($this->code))]);
        if ($this->has('name')) $this->merge(['name' => trim($this->name)]);
    }
}
