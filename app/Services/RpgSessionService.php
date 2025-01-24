<?php

namespace App\Services;

use App\Interfaces\RpgSessionInterface;

class RpgSessionService
{
    protected RpgSessionInterface $rpgSessionRepository;

    public function __construct(RpgSessionInterface $rpgSessionRepository)
    {
        $this->rpgSessionRepository = $rpgSessionRepository;
    }

    public function getAllSessions()
    {
        return $this->rpgSessionRepository->getAll();
    }

    public function getSessionById(int $id)
    {
        return $this->rpgSessionRepository->getById($id);
    }

    public function createSession(array $data)
    {
        return $this->rpgSessionRepository->create($data);
    }

    public function updateSession(int $id, array $data)
    {
        return $this->rpgSessionRepository->update($id, $data);
    }

    public function deleteSession(int $id)
    {
        return $this->rpgSessionRepository->delete($id);
    }
}
