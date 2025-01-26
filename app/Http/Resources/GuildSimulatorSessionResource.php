<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuildSimulatorSessionResource extends JsonResource
{
    public function toArray($request)
    {
        $data = $this->resource;

        return [
                'guild_name' => $data['guild_name'],
                'players' => $this->transformPlayers($data['players']),
                'total_xp' => $data['total_xp'],
                'missing_classes' => $data['missing_classes']
            ];
    }

    private function transformPlayers(array $players)
    {
        return collect($players)->map(function ($player) {
            return [
                'name' => $player['name'],
                'xp' => $player['xp'],
                'class' => [
                    'id' => $player['class']['id'],
                    'name' => $player['class']['name'],
                ],
            ];
        });
    }
}
