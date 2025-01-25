<?php

namespace App\Services;

use App\Interfaces\Repositories\PlayerClassInterface;

class PlayerClassService
{
    protected PlayerClassInterface $playerRepository;

    public function __construct(PlayerClassInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function getAllClasses()
    {
        return $this->playerRepository->getAll();
    }
}
