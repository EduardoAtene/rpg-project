<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Exceptions\ValidateException;
use App\Interfaces\Repositories\RpgSessionInterface;
use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Interfaces\Strategies\GuildDistributionStrategyInterface;
use App\Services\Validation\GuildValidationService;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;
    protected PlayerSessionInterface $playerSessionRepository;
    protected GuildValidationService $guildValidationService;
    protected GuildDistributionStrategyInterface $distributionStrategy;

    public function __construct(
        RpgSessionInterface $rpgSessionRepository,
        PlayerSessionInterface $playerSessionRepository,
        GuildValidationService $guildValidationService,
        GuildDistributionStrategyInterface $distributionStrategy
    ) {
        $this->rpgSessionRepository = $rpgSessionRepository;
        $this->playerSessionRepository = $playerSessionRepository;
        $this->guildValidationService = $guildValidationService;
        $this->distributionStrategy = $distributionStrategy;
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
                'missing_classes' => [],
                'total_xp' => 0,
            ];
        }, $guilds);

        $players = $playerAssociate->toArray();

        $this->distributionStrategy->distribute($players, $data);

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
