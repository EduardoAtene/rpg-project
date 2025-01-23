<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerSession extends Pivot
{
    protected $table = 'player_session';

    protected $fillable = ['player_id', 'session_id', 'status'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function session()
    {
        return $this->belongsTo(RPGSession::class);
    }
}