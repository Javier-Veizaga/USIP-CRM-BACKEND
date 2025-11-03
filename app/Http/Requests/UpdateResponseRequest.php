<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResponseRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('response'); // funciona con apiResource

        return [
            'response'    => ['sometimes','string','max:20', Rule::unique('responses','response')->ignore($id)],
            'description' => ['sometimes','nullable','string'],
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->has('response')) {
            $v = trim((string)$this->response);
            $v = mb_strtolower($v, 'UTF-8');
            $this->merge([
                'response' => mb_strtoupper(mb_substr($v,0,1,'UTF-8'), 'UTF-8') . mb_substr($v,1,null,'UTF-8')
            ]);
        }
    }
}
