<?php

namespace App\Repositories;

use App\Interfaces\PlayerSessionInterface;
use App\Models\Player;
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

    public function filterPlayers(int $sessionId, array $filters)
    {
        $query = Player::query();
        $this->applySessionFilter($query, $sessionId, $filters['associated']);

        return $query->get();
    }

    private function applySessionFilter($query, int $sessionId, bool $associated)
    {
        if ($associated) {
            $query->whereHas('sessions', function ($q) use ($sessionId) {
                $q->where('session_id', $sessionId);
            });

            return;
        }

        $query->whereDoesntHave('sessions', function ($q) use ($sessionId) {
            $q->where('session_id', $sessionId);
        });
    }
}
