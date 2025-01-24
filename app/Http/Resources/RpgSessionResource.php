<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\DateHelper;

class RpgSessionResource extends JsonResource
{
    public static string $sessionsLabel = 'sessions';
    public static string $sessionLabel = 'session';

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status, 
            'date_session' => DateHelper::formatDateTime($this->date_session),
            'description' => $this->description,
        ];
    }
}
