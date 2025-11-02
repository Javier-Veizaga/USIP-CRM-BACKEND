<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $userId = $this->route('user'); // funciona con apiResource

        return [
            'first_name'         => ['sometimes','string','max:50'],
            'last_name'          => ['sometimes','string','max:50'],
            'maternal_last_name' => ['nullable','string','max:50'],
            'email'              => ['sometimes','email','max:120', Rule::unique('users','email')->ignore($userId)],
            'phone'              => ['sometimes','string','max:20', Rule::unique('users','phone')->ignore($userId)],
            'role_id'            => ['sometimes','exists:roles,id'],
            'password'           => ['nullable','string','min:8'], // si la envías, se rehasea por el mutator
            'is_active'          => ['sometimes','boolean'],
        ];
    }
}
