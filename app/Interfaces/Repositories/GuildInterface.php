<?php

namespace App\Interfaces\Repositories;

interface GuildInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function findBySessionId(int $sessionId);
}
