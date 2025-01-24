<?php

namespace App\Interfaces;

interface PlayerSessionInterface
{
    public function filterPlayers(int $sessionId, array $filters);
}
