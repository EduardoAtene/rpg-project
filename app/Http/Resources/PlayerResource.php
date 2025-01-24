<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    public static string $playersLabel = "players";
    public static string $playerLabel = "player";

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'xp' => $this->xp,
            'class' => [
                'id' => $this->class->id,
                'name' => $this->class->name,
            ],
        ];
    }
}
