<?php

namespace App\Interfaces\Repositories;

interface PlayerSessionInterface
{
    public function filterPlayers(int $sessionId, array $filters);
    public function associatePlayers(int $sessionId, array $playerIds);
    public function unassociatePlayers(int $sessionId, array $playerIds);
    public function unassociateAllPlayersFromSession(int $sessionId);
    public function getAllPlayersAssociateSession(int $sessionId);
}
