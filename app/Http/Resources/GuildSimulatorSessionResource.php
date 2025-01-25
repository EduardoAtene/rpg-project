<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuildSimulatorSessionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'session_id' => $this->session_id,
            'total_guilds' => $this->qnt_guilds,
            'guilds' => $this->guilds->map(function ($guild) {
                return [
                    'name' => $guild['name'],
                    'player_count' => $guild['player_count'],
                ];
            }),
        ];
    }
}
