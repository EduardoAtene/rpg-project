<?php

namespace App\Repositories;

use App\Interfaces\RpgSessionInterface;
use App\Models\RpgSession;

class RpgSessionRepository implements RpgSessionInterface
{
    public function getAll()
    {
        return RpgSession::all();
    }

    public function findById($id)
    {
        return RpgSession::findOrFail($id);
    }

    public function create(array $data)
    {
        return RpgSession::create($data);
    }

    public function update($id, array $data)
    {
        $session = RpgSession::findOrFail($id);
        $session->update($data);
        return $session;
    }

    public function delete($id)
    {
        $session = RpgSession::findOrFail($id);
        $session->delete();
    }
}
