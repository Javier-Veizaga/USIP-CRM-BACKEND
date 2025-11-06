<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'                 => ['required','string','max:150','unique:schools,name'],
            'school_management_id' => ['required','integer','exists:school_management,id'],
            'school_shift_id'      => ['required','integer','exists:school_shifts,id'],
            'agreement_type_id'    => ['nullable','integer','exists:agreement_types,id'],
            'agreement_status_id'  => ['nullable','integer','exists:agreement_statuses,id'],
            'address'              => ['required','string','max:255'],
        ];
    }

    public function prepareForValidation(): void
    {
        foreach (['name','address'] as $k) {
            if ($this->has($k)) $this->merge([$k => trim((string)$this->$k)]);
        }
    }
}
