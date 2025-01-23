<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePlayerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Caso futuramente a gente tiver alteração
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'xp' => 'required|integer',
            'player_class_id' => 'required|exists:player_class,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do jogador é obrigatório.',
            'xp.required' => 'O XP do jogador é obrigatório.',
            'player_class_id.exists' => 'A classe do jogador deve ser válida.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Retorna um JSON estruturado
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erro de validação',
            'errors' => $validator->errors(), // Erros de validação
        ], 422)); // Código de status 422 - Unprocessable Entity
    }
}
