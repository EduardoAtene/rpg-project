<?php

namespace App\Repositories;

use App\Interfaces\RpgSessionInterface;
use App\Models\RpgSession;

class RpgSessionRepository implements RpgSessionInterface
{
    protected RpgSession $rpgSessionModel;

    public function __construct(RpgSession $rpgSessionModel)
    {
        $this->rpgSessionModel = $rpgSessionModel;
    }

    public function getAll()
    {
        return $this->rpgSessionModel->all();
    }

    public function getById($id)
    {
        return $this->rpgSessionModel->find($id);
    }

    public function create($data)
    {
        return $this->rpgSessionModel->create($data);
    }

    public function update($id, array $data)
    {
        $session = $this->getById($id);
        if (!$session) {
            return null;
        }

        $session->update($data);

        return $session;
    }

    public function delete($id)
    {
        $session = $this->getById($id);
        if (!$session) {
            return null;
        }

        $session->delete();

        return $session;
    }
}
