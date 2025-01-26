<?php

namespace App\Services;

use App\Interfaces\Repositories\GuildInterface;

class GuildService
{
    private GuildInterface $guildRepository;

    public function __construct(GuildInterface $guildRepository)
    {
        $this->guildRepository = $guildRepository;
    }

    public function getGuildById(int $id)
    {
        return $this->guildRepository->findById($id);
    }

    public function getGuildsBySession(int $sessionId)
    {
        return $this->guildRepository->findBySessionId($sessionId);
    }
}
