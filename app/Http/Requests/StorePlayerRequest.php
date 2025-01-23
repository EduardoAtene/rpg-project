<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
{
    use ValidationRequestFailed;

    public function authorize(): bool
    {
        return true; // Caso futuramente a gente tiver alteração
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'xp' => 'required|integer|min:1|max:100',
            'player_class_id' => 'required|exists:player_class,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do jogador é obrigatório.',
            'name.string' => 'O nome do jogador deve ser uma string.',
            'xp.required' => 'O XP do jogador é obrigatório.',
            'xp.integer' => 'O valor do XP deve ser um inteiro.',
            'xp.min' => 'O valor mínimo XP é 1.',
            'xp.max' => 'O valor máximo XP é 100.',
            'player_class_id.exists' => 'A classe do jogador deve ser válida.',
        ];
    }
}
