<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResponseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'response'    => ['required','string','max:20','unique:responses,response'],
            'description' => ['nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('response')) {
            // Normaliza: primera letra mayúscula, resto minúsculas
            $v = trim((string)$this->response);
            $v = mb_strtolower($v, 'UTF-8');
            $this->merge([
                'response' => mb_strtoupper(mb_substr($v,0,1,'UTF-8'), 'UTF-8') . mb_substr($v,1,null,'UTF-8')
            ]);
        }
    }
}
