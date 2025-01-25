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
                'missing_classes' => [],
                'total_xp' => 0,
            ];
        }, $guilds);

        $players = $playerAssociate->toArray();

        $this->distributeClassesAmongGuilds($players, $data);

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


    private function distributeClassesAmongGuilds(array $players, array &$guilds): void
    {
        $classes = [
            1 => 'Guerreiro',
            2 => 'Mago',
            3 => 'Arqueiro',
            4 => 'Clérigo',
        ];
    
        $playersGroupedByClass = collect($players)->groupBy(fn($player) => $player['class']['id'])->toArray();
    
        $suportGroup = $playersGroupedByClass[4] ?? [];
        $warriorGroup = $playersGroupedByClass[1] ?? [];
        $rangedGroup = array_merge(
            $playersGroupedByClass[2] ?? [],
            $playersGroupedByClass[3] ?? []
        );
    
        foreach ($guilds as &$guild) {
            $guild['players'] = [];
            $guild['missing_classes'] = [];
    
            if (!empty($suportGroup)) {
                $guild['players'][] = array_shift($suportGroup);
            } else {
                $guild['missing_classes'][] = $classes[4];
            }
    
            if (!empty($warriorGroup)) {
                $guild['players'][] = array_shift($warriorGroup);
            } else {
                $guild['missing_classes'][] = $classes[1];
            }
    
            if (!empty($rangedGroup)) {
                $guild['players'][] = array_shift($rangedGroup);
            } else {
                $guild['missing_classes'][] = 'Ataque à Distância (' . $classes[2] . ' ou ' . $classes[3] . ')';
            }
    
            while (count($guild['players']) < $guild['qnt_players']) {
                if (!empty($suportGroup)) {
                    $guild['players'][] = array_shift($suportGroup);
                } elseif (!empty($warriorGroup)) {
                    $guild['players'][] = array_shift($warriorGroup);
                } elseif (!empty($rangedGroup)) {
                    $guild['players'][] = array_shift($rangedGroup);
                } else {
                    break;
                }
            }
    
            $guild['total_xp'] = array_sum(array_column($guild['players'], 'xp'));
        }
    }
    
}
