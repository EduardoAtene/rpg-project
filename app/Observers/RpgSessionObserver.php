<?php

namespace App\Observers;

use App\Models\RpgSession;

class RpgSessionObserver
{
    public function creating(RpgSession $session)
    {
        if (is_null($session->status)) {
            $session->status = 'waiting';
        }
    }
}
