<?php

namespace App\Repositories;

use App\Interfaces\Repositories\GuildInterface;
use App\Models\Guild;

class GuildRepository implements GuildInterface
{
    protected Guild $guildModel;

    public function __construct(Guild $guildModel)
    {
        $this->guildModel = $guildModel;
    }

    public function create(array $data)
    {
        return $this->guildModel->create($data);
    }
}
