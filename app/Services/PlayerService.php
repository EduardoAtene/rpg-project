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

    public function getAllClass()
    {
        return $this->playerRepository->getAll();
    }
}
