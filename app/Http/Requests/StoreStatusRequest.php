<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'status'      => ['required','string','max:30','unique:statuses,status'],
            'description' => ['nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('status')) {
            $v = trim((string)$this->status);
            $v = mb_strtolower($v, 'UTF-8');
            $this->merge([
                'status' => mb_strtoupper(mb_substr($v,0,1,'UTF-8'), 'UTF-8') . mb_substr($v,1,null,'UTF-8')
            ]);
        }
    }
}
