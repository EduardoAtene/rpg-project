<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnassociatePlayerSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'player_ids' => 'required|array',
            'player_ids.*' => 'exists:players,id',
        ];
    }
}
