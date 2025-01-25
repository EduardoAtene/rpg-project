<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Exceptions\ValidateException;
use App\Interfaces\Repositories\GuildInterface;
use App\Interfaces\Repositories\PlayerGuildInterface;
use App\Interfaces\Repositories\RpgSessionInterface;
use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Interfaces\Strategies\GuildDistributionStrategyInterface;
use App\Services\Validation\GuildValidationService;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;
    protected PlayerSessionInterface $playerSessionRepository;
    protected GuildInterface $guildRepository;
    protected PlayerGuildInterface $playerGuildRepository;
    protected GuildValidationService $guildValidationService;
    protected GuildDistributionStrategyInterface $guildDistributionStrategy;

    public function __construct(
        RpgSessionInterface $rpgSessionRepository,
        PlayerSessionInterface $playerSessionRepository,
        GuildInterface $guildRepository,
        PlayerGuildInterface $playerGuildRepository,
        GuildValidationService $guildValidationService,
        GuildDistributionStrategyInterface $guildDistributionStrategy
    ) {
        $this->rpgSessionRepository = $rpgSessionRepository;
        $this->playerSessionRepository = $playerSessionRepository;
        $this->guildRepository = $guildRepository;
        $this->playerGuildRepository = $playerGuildRepository;
        $this->guildValidationService = $guildValidationService;
        $this->guildDistributionStrategy = $guildDistributionStrategy;
    }

    public function simulate(array $validatedData): array
    {
        $rpgSession = $this->getRpgSession($validatedData['session_id']);

        $this->validateStatusRpgSession($rpgSession);

        $playerAssociate = $this->playerSessionRepository->getAllPlayersAssociateSession($rpgSession->id);

        $this->guildValidationService->validateQntGuildsByQntPlayers($validatedData, $playerAssociate->count());

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

        $this->guildDistributionStrategy->distribute($players, $data);

        return $data;
    }

    public function confirm(array $validatedData): array
    {
        $simulationDaata = $this->simulate($validatedData);
        $sessionId = $validatedData['session_id'];

        foreach ($simulationDaata as $guildData) {
            $guild = $this->guildRepository->create([
                'name' => $guildData['guild_name'],
                'session_id' => $sessionId,
                'total_xp' => $guildData['total_xp'],
            ]);

            foreach ($guildData['players'] as $player) {
                $this->playerGuildRepository->create([
                    'guild_id' => $guild->id,
                    'player_id' => $player['id'],
                    'player_xp' => $player['xp'],
                ]);
            }
        }

        $data = [
            "status" => "closed"
        ];

        $this->rpgSessionRepository->update($sessionId, $data);

        return $simulationDaata;
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
