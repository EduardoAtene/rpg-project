<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuildResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'guild_name' => $this->name,
            'players' => $this->players->map(function ($player) {
                return [
                    'name' => $player->name,
                    'xp' => $player->xp,
                    'class' => [
                        'id' => $player->class->id,
                        'name' => $player->class->name,
                    ],
                ];
            }),
        ];
    }
}
