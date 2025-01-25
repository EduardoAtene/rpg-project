<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PlayerSessionInterface;
use App\Models\Player;
use App\Models\PlayerSession;

class PlayerSessionRepository implements PlayerSessionInterface
{
    protected Player $playerModel;
    protected PlayerSession $playerSessionModel;

    public function __construct(
        PlayerSession $playerSessionModel,
        Player $playerModel
        )
    {
        $this->playerSessionModel = $playerSessionModel;
        $this->playerModel = $playerModel;
    }

    public function filterPlayers(int $sessionId, array $filters)
    {
        $query = $this->playerModel->query();
    
        $this->applySessionFilter($query, $sessionId, $filters['associated']);

        return $query->get();
    }

    public function associatePlayers(int $sessionId, array $playerIds)
    {
        foreach ($playerIds as $playerId) {
            $this->playerSessionModel->updateOrCreate(
                ['player_id' => $playerId, 'session_id' => $sessionId],
                ['status' => 'attend']
            );
        }
    }

    public function unassociatePlayers(int $sessionId, array $playerIds)
    {
        $this->playerSessionModel->where('session_id', $sessionId)
            ->whereIn('player_id', $playerIds)
            ->delete(['status' => 'missing']);
    }

    public function getAllPlayersAssociateSession(int $sessionId)
    {
        return $this->playerModel->whereHas('sessions', function ($query) use ($sessionId) {
            $query->where('session_id', $sessionId)
                  ->where('player_session.status', 'attend');
        })->get();
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
