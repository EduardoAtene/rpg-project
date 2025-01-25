<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class GuildSimulatorSessionRequest extends FormRequest
{
    use ValidationRequestFailed;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'session_id' => 'required|integer',
            'qnt_guilds' => 'required|integer|min:1',
            'guilds' => 'required|array|min:1',
            'guilds.*.name' => 'required|string|max:255',
            'guilds.*.player_count' => 'required|integer|min:3',
        ];
    }

    public function messages(): array
    {
        return [
            'session_id.required' => 'O campo session_id é obrigatório.',
            'session_id.integer' => 'O campo session_id deve ser um número inteiro.',
            'qnt_guilds.required' => 'O campo qnt_guilds é obrigatório.',
            'qnt_guilds.integer' => 'O campo qnt_guilds deve ser um número inteiro.',
            'qnt_guilds.min' => 'O campo qnt_guilds deve ser pelo menos 1.',
            'guilds.required' => 'A lista de guildas (guilds) é obrigatória.',
            'guilds.array' => 'O campo guilds deve ser um array.',
            'guilds.min' => 'O campo guilds deve conter pelo menos uma guilda.',
            'guilds.*.name.required' => 'O campo name de cada guilda é obrigatório.',
            'guilds.*.name.string' => 'O campo name de cada guilda deve ser uma string.',
            'guilds.*.name.max' => 'O campo name de cada guilda não pode exceder 255 caracteres.',
            'guilds.*.player_count.required' => 'O campo player_count de cada guilda é obrigatório.',
            'guilds.*.player_count.integer' => 'O campo player_count de cada guilda deve ser um número inteiro.',
            'guilds.*.player_count.min' => 'O campo player_count de cada guilda deve ser pelo menos 1.',
        ];
    }
}
