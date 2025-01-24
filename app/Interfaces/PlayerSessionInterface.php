<?php

namespace App\Interfaces;

interface PlayerSessionInterface
{
    public function filterPlayers(int $sessionId, array $filters);
    public function associatePlayers(int $sessionId, array $playerIds);
    public function unassociatePlayers(int $sessionId, array $playerIds);
}
