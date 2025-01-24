<?php

namespace App\Services;

use App\Interfaces\PlayerInterface;

class PlayerService
{
    protected PlayerInterface $playerRepository;

    public function __construct(PlayerInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function getAllPlayers()
    {
        return $this->playerRepository->getAll();
    }

    public function getPlayerById($id)
    {
        return $this->playerRepository->getById($id);
    }

    public function createPlayer(array $data)
    {
        return $this->playerRepository->create($data);
    }

    public function updatePlayer($id, array $data)
    {
        return $this->playerRepository->update($id, $data);
    }

    public function deletePlayer($id)
    {
        return $this->playerRepository->delete($id);
    }
}
