<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Exceptions\ValidateException;
use App\Interfaces\Repositories\RpgSessionInterface;
use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Services\Validation\GuildValidationService;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;
    protected PlayerSessionInterface $playerSessionRepository;
    protected GuildValidationService $guildValidationService;

    public function __construct(
        RpgSessionInterface $rpgSessionRepository,
        PlayerSessionInterface $playerSessionRepository,
        GuildValidationService $guildValidationService
    ) {
        $this->rpgSessionRepository = $rpgSessionRepository;
        $this->playerSessionRepository = $playerSessionRepository;
        $this->guildValidationService = $guildValidationService;
    }

    public function simulate(array $validatedData): array
    {
        $rpgSession = $this->getRpgSession($validatedData['session_id']);

        $this->validateStatusRpgSession($rpgSession);

        $playerAssociate = $this->playerSessionRepository->getAllPlayersAssociateSession($rpgSession->id);

        $this->guildValidationService->validateQntGuildsByQntPlayers($validatedData, $playerAssociate->count());
        $this->guildValidationService->validateStatusPlayers($playerAssociate);

        $guilds = $validatedData['guilds'];
        $data = array_map(function ($guild) {
            return [
                'guild_name' => $guild['name'],
                'qnt_players' => $guild['player_count'],
                'players' => [],
                'total_xp' => 0,
            ];
        }, $guilds);

        $players = $playerAssociate->toArray();
        $totalPlayers = count($players);
        $currentPlayerIndex = 0;

        foreach ($data as $key => $guild) {
            $playerCount = $guild['qnt_players'];
            $guildPlayers = array_slice($players, $currentPlayerIndex, $playerCount);
            $data[$key]['players'] = $guildPlayers;
    
            $data[$key]['total_xp'] = array_sum(array_column($guildPlayers, 'xp'));
    
            $currentPlayerIndex += $playerCount;
        }

        return $data;
    }

    public function confirm(array $validatedData): array
    {
        return $this->simulate($validatedData);
    }

    private function getRpgSession(int $sessionId): object
    {
        $session = $this->rpgSessionRepository->getById($sessionId);
        if (!$session) {
            throw new RpgSessionNotFoundException("A sessão de RPG com o ID {$sessionId} não foi encontrada.");
        }

        return $session;
    }

    private function validateStatusRpgSession(object $rpgSession): void
    {
        if ($rpgSession->status === 'waiting') {
            throw new ValidateException("A sessão de RPG com o ID {$rpgSession->id} ainda não iniciou.");
        }

        if ($rpgSession->status === 'closed') {
            throw new ValidateException("A sessão de RPG com o ID {$rpgSession->id} já foi fechada.");
        }
    }
}
