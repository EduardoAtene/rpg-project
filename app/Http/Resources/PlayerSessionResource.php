<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerSessionResource extends JsonResource
{
    public static string $playerSessionLabel = "players_session";
    public static string $playersAssociatedLabel = "players_associated";

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
