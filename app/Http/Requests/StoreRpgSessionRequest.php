<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class StoreRpgSessionRequest extends FormRequest
{
    use ValidationRequestFailed;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'date_session' => 'required|date',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da sessão é obrigatório.',
            'name.string' => 'O nome da sessão deve ser uma string.',
            'date_session.required' => 'A data da sessão é obrigatório.',
            'date_session.date' => 'O valor da sessão deve ser uma data.',
            'description.string' => 'A descrissão deve ser uma string.',
        ];
    }
}
