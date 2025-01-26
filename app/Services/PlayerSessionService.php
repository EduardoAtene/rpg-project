<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Interfaces\Repositories\RpgSessionInterface;

class PlayerSessionService
{
    protected PlayerSessionInterface $playerSessionRepository;
    protected RpgSessionInterface $rpgSessionRepository;

    public function __construct(
        PlayerSessionInterface $playerSessionRepository, 
        RpgSessionInterface $rpgSessionRepository
    ) {
        $this->playerSessionRepository = $playerSessionRepository;
        $this->rpgSessionRepository = $rpgSessionRepository;
    }

    public function filterPlayersBySession(int $sessionId, array $filters)
    {
        $this->validateSessionExists($sessionId);

        return $this->playerSessionRepository->filterPlayers($sessionId, $filters);
    }


    public function associatePlayersToSession(int $sessionId, array $playerIds)
    {
        $this->validateSessionExists($sessionId);

        $this->playerSessionRepository->unassociateAllPlayersFromSession($sessionId);
        
        $this->playerSessionRepository->associatePlayers($sessionId, $playerIds);
    }

    public function unassociatePlayersFromSession(int $sessionId, array $playerIds)
    {
        $this->validateSessionExists($sessionId);

        $this->playerSessionRepository->unassociatePlayers($sessionId, $playerIds);
    }

    private function validateSessionExists(int $sessionId): void
    {
        if (!$this->rpgSessionRepository->getById($sessionId)) {
            throw new RpgSessionNotFoundException("A sessão do rpg com o ID {$sessionId} não foi encontrada.");
        }
    }
}
