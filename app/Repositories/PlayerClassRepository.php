<?php

namespace App\Repositories;

use App\Interfaces\PlayerClassInterface;
use App\Models\PlayerClass;

class PlayerClassRepository implements PlayerClassInterface
{
    protected PlayerClass $playerClassModel;

    public function __construct(PlayerClass $playerClassModel)
    {
        $this->playerClassModel = $playerClassModel;
    }

    public function getAll()
    {
        return $this->playerClassModel->all();
    }
}
