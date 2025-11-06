<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProspectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'first_name'      => ['required','string','max:50'],
            'last_name'       => ['required','string','max:50'],
            'maternal_last_name' => ['nullable','string','max:50'],
            'phone'           => ['required','string','max:20','unique:prospects,phone'],
            'school_id'       => ['required','integer','exists:schools,id'],
            'address'         => ['required','string','max:255'],
            'data_origin_id'  => ['required','integer','exists:data_sources,id'],
            'user_id'         => ['required','integer','exists:users,id'],
            'status_id'       => ['required','integer','exists:statuses,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        foreach (['first_name','last_name','maternal_last_name','address','phone'] as $k) {
            if ($this->has($k)) $this->merge([$k => trim((string)$this->$k)]);
        }
    }
}
