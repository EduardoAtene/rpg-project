<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PlayerInterface;
use App\Models\Player;

class PlayerRepository implements PlayerInterface
{
    protected Player $playerModel;

    public function __construct(Player $playerModel)
    {
        $this->playerModel = $playerModel;
    }

    public function getAll()
    {
        return $this->playerModel->with('class')->get();
    }

    public function getById($id)
    {
        return $this->playerModel->with('class')->find($id);
    }

    public function create($data)
    {
        return $this->playerModel->create($data);
    }

    public function update($id, array $data)
    {
        $player = $this->getById($id);

        if (!$player) {
            return null;
        }

        $player->update($data);
        return $player;
    }

    public function delete($id)
    {
        $player = $this->getById($id);

        if (!$player) {
            return null;
        }

        $player->delete();
        return $player;
    }
}
