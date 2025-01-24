<?php

namespace App\Repositories;

use App\Interfaces\PlayerSessionInterface;
use App\Models\PlayerClass;
use App\Models\PlayerSession;
use App\Services\PlayerService;

class PlayerSessionRepository implements PlayerSessionInterface
{
    protected PlayerSession $playerSessionModel;

    public function __construct(PlayerSession $playerSessionModel)
    {
        $this->playerSessionModel = $playerSessionModel;
    }
}
