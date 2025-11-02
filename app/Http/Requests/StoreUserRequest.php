<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'first_name'         => ['required','string','max:50'],
            'last_name'          => ['required','string','max:50'],
            'maternal_last_name' => ['nullable','string','max:50'],
            'email'              => ['required','email','max:120','unique:users,email'],
            'phone'              => ['required','string','max:20','unique:users,phone'],
            'role_id'            => ['required','exists:roles,id'],
            'password'           => ['required','string','min:8'],
            'is_active'          => ['sometimes','boolean'],
        ];
    }
}
