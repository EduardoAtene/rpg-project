<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePlayerRequest extends FormRequest
{
    use ValidationRequestFailed;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'xp' => 'sometimes|integer|min:1|max:100',
            // 'player_class_id' => 'sometimes|exists:player_class,id', 
            // Vou fazer nesse momento para a pesso não editar a classe, ignorar e depois limpar esse carinha
        ];
    }

    public function messages(): array
    {
        return [
            'name.sometimes' => 'O campo nome é opcional, mas deve ser enviado corretamente se fornecido.',
            'name.string' => 'O nome do jogador deve ser uma string.',
            'name.max' => 'O nome do jogador não pode ter mais que 255 caracteres.',
            'xp.sometimes' => 'O campo XP é opcional, mas deve ser enviado corretamente se fornecido.',
            'xp.integer' => 'O valor do XP deve ser um número inteiro.',
            'xp.min' => 'O valor mínimo do XP deve ser 1.',
            'xp.max' => 'O valor máximo do XP deve ser 100.',
            // 'player_class_id.sometimes' => 'O campo Classe do jogador é opcional, mas deve ser enviado corretamente se fornecido.',
            // 'player_class_id.exists' => 'A classe do jogador selecionada deve existir no sistema.',
        ];
    }
}
