<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProspectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('prospect');

        return [
            'first_name'      => ['sometimes','string','max:50'],
            'last_name'       => ['sometimes','string','max:50'],
            'maternal_last_name' => ['sometimes','nullable','string','max:50'],
            'phone'           => ['sometimes','string','max:20', Rule::unique('prospects','phone')->ignore($id)],
            'school_id'       => ['sometimes','integer','exists:schools,id'],
            'address'         => ['sometimes','string','max:255'],
            'data_origin_id'  => ['sometimes','integer','exists:data_sources,id'],
            'user_id'         => ['sometimes','integer','exists:users,id'],
            'status_id'       => ['sometimes','integer','exists:statuses,id'],
        ];
    }

    public function prepareForValidation(): void
    {
        foreach (['first_name','last_name','maternal_last_name','address','phone'] as $k) {
            if ($this->has($k)) $this->merge([$k => trim((string)$this->$k)]);
        }
    }
}
