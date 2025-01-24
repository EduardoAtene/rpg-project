<?php

namespace App\Services;

use App\Interfaces\PlayerSessionInterface;
use App\Interfaces\RpgSessionInterface;
use Exception;

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
        $session = $this->rpgSessionRepository->getById($sessionId);

        if (!$session) {
            throw new Exception('Sessão não encontrada.', 404);
        }

        return $this->playerSessionRepository->filterPlayers($sessionId, $filters);
    }
}
