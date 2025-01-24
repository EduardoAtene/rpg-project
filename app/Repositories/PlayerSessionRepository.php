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

    public function associatePlayers(int $sessionId, array $playerIds)
    {
        foreach ($playerIds as $playerId) {
            PlayerSession::updateOrCreate(
                ['player_id' => $playerId, 'session_id' => $sessionId],
                ['status' => 'attend']
            );
        }
    }

    public function unassociatePlayers(int $sessionId, array $playerIds)
    {
        PlayerSession::where('session_id', $sessionId)
            ->whereIn('player_id', $playerIds)
            ->delete(['status' => 'missing']);
    }

    private function applySessionFilter($query, int $sessionId, bool $associated)
    {
        if ($associated) {
            $query->whereHas('sessions', function ($q) use ($sessionId) {
                $q  ->where('session_id', $sessionId)
                    ->where('player_session.status', 'attend'); 

            });

            return;
        }

        $query->whereDoesntHave('sessions', function ($q) use ($sessionId) {
            $q->where('session_id', $sessionId);
        });
    }
}
