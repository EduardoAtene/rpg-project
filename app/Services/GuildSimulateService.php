<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Exceptions\ValidateException;
use App\Interfaces\RpgSessionInterface;
use App\Repositories\PlayerSessionRepository;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;
    protected PlayerSessionRepository $playerSessionRepository;

    public function __construct(
        RpgSessionInterface $rpgSessionRepository,
        PlayerSessionRepository $playerSessionRepository
    )
    {
        $this->rpgSessionRepository = $rpgSessionRepository;
        $this->playerSessionRepository = $playerSessionRepository;
    }

    public function simulate(array $validatedData): array
    {
        $rpgSession = $this->getRpgSession($validatedData['session_id']);

        $this->validateStatusRpgSession($rpgSession);

        $playerAssociate = $this->playerSessionRepository->getAllPlayersAssociateSession($rpgSession->id);
    
        $this->validateRuleGuilds($playerAssociate);
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

    private function getRpgSession(int $sessionId): object
    {
        $session = $this->rpgSessionRepository->getById($sessionId);
        if (!$session) {
            throw new RpgSessionNotFoundException("A sessão de rpg  com o ID {$sessionId} não foi encontrada.");
        }

        return $session;
    }

    private function validateStatusRpgSession(object $rpgSession): void
    {
        if ($rpgSession->status === 'waiting') {
            throw new ValidateException("A sessão de rpg com o ID {$rpgSession->id} ainda nao iniciou.");
        }

        if ($rpgSession->status === 'closed') {
            throw new ValidateException("A sessão de rpg com o ID {$rpgSession->id} ja foi fechada.");
        }
    }

    private function validateRuleGuilds(object $playerSession): void
    {
        foreach ($playerSession as $player) {
            if ($player->status == 'attend') {
                throw new ValidateException("O jogador {$player->id} nao esta presente.");
            }
            
        }
    }
}
