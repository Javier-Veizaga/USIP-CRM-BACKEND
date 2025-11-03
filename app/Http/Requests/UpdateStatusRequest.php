<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStatusRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('status'); // apiResource binding

        return [
            'status'      => ['sometimes','string','max:30', Rule::unique('statuses','status')->ignore($id)],
            'description' => ['sometimes','nullable','string'],
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
