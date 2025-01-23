<?php

namespace App\Services;

use App\Interfaces\PlayerInterface;

class PlayerService
{
    protected $playerRepository;

    public function __construct(PlayerInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function getAllPlayers()
    {
        return $this->playerRepository->index();
    }

    public function createPlayer($data)
    {
        return $this->playerRepository->store($data);
    }

    public function getPlayerById($id)
    {
        return $this->playerRepository->show($id);
    }

    public function updatePlayer($data, $id)
    {
        return $this->playerRepository->update($data, $id);
    }

    public function deletePlayer($id)
    {
        return $this->playerRepository->destroy($id);
    }
}
