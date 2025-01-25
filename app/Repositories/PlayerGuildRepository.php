<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PlayerGuildInterface;
use App\Models\PlayerGuild;

class PlayerGuildRepository implements PlayerGuildInterface
{
    protected PlayerGuild $playerGuildModel;

    public function __construct(PlayerGuild $playerGuildModel)
    {
        $this->playerGuildModel = $playerGuildModel;
    }

    public function create(array $data)
    {
        return $this->playerGuildModel->create($data);
    }
}
