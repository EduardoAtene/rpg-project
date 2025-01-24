<?php

namespace App\Services;

use App\Interfaces\PlayerSessionInterface;

class PlayerSessionService
{
    protected PlayerSessionInterface $playerSessionRepository;

    public function __construct(PlayerSessionInterface $playerSessionRepository)
    {
        $this->playerSessionRepository = $playerSessionRepository;
    }

}
