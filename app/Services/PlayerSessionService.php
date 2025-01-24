<?php

namespace App\Services;

use App\Interfaces\PlayerSessionInterface;
use App\Repositories\RpgSessionRepository;

class PlayerSessionService
{
    protected PlayerSessionInterface $playerSessionRepository;
    protected RpgSessionRepository $rpgSessionRepository;

    public function __construct(
        PlayerSessionInterface $playerSessionRepository, 
        RpgSessionRepository $rpgSessionRepository,
    ) {
        $this->playerSessionRepository = $playerSessionRepository;
        $this->rpgSessionRepository = $rpgSessionRepository;
    }

    public function getAllPlayersAssociateSession($sessionId)
    {

    }

}
