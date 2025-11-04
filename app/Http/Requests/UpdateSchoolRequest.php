<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('school');

        return [
            'name'                 => ['sometimes','string','max:150', Rule::unique('schools','name')->ignore($id)],
            'school_management_id' => ['sometimes','integer','exists:school_managements,id'],
            'school_shift_id'      => ['sometimes','integer','exists:school_shifts,id'],
            'agreement_type_id'    => ['sometimes','nullable','integer','exists:agreement_types,id'],
            'agreement_status_id'  => ['sometimes','nullable','integer','exists:agreement_statuses,id'],
            'address'              => ['sometimes','string','max:255'],
        ];
    }

    public function prepareForValidation(): void
    {
        foreach (['name','address'] as $k) {
            if ($this->has($k)) $this->merge([$k => trim((string)$this->$k)]);
        }
    }
}
