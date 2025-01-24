<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class FilterPlayersSessionRequest extends FormRequest
{
    use ValidationRequestFailed;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'associated' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'associated.required' => 'O parâmetro "associated" é obrigatório.',
            'associated.boolean' => 'O parâmetro "associated" deve ser 1 ou 0 para false.',
        ];
    }
}
