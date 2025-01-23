<?php

namespace App\Http\Requests;

use App\Traits\ValidationRequestFailed;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRpgSessionRequest extends FormRequest
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
            'date_session' => 'sometimes|date',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:waiting,in_progress,closed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome da sessão deve ser uma string.',
            'date_session.date' => 'O valor da sessão deve ser uma data.',
            'description.string' => 'A descrissão deve ser uma string.',
            'status.in' => 'O status da sessão deve ser um dos seguintes: waiting, in_progress, closed.',
        ];
    }
}
