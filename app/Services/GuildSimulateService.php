<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Interfaces\RpgSessionInterface;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;

    public function __construct(RpgSessionInterface $rpgSessionRepository)
    {
        $this->rpgSessionRepository = $rpgSessionRepository;
    }

    public function simulate(array $validatedData): array
    {
        $this->validateSessionExists($validatedData['session_id']);


        $guilds = $validatedData['guilds'];
        $data = [];

        foreach ($guilds as $guild) {
            $players = [
                [
                    "id" => 1,
                    "name" => "Jogador 1",
                    "xp" => 120,
                    "class" => "Guerreiro",
                ],
                [
                    "id" => 2,
                    "name" => "Jogador 2",
                    "xp" => 80,
                    "class" => "Mago",
                ],
            ];

            $totalXp = array_sum(array_column($players, 'xp'));

            $data[] = [
                'guild_name' => $guild['name'],
                'players' => $players,
                'total_xp' => $totalXp,
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Simulação de guildas concluída com sucesso.',
            'data' => $data,
        ];
    }

    public function confirm(array $validatedData): array
    {
        //
        return [
            'status' => 'success',
            'message' => 'Confirmação de guildas concluída com sucesso.',
            'data' => $this->simulate($validatedData)['data'],
        ];
    }

    private function validateSessionExists(int $sessionId): void
    {
        if (!$this->rpgSessionRepository->getById($sessionId)) {
            throw new RpgSessionNotFoundException("A sessão com o ID {$sessionId} não foi encontrada.");
        }
    }
}
