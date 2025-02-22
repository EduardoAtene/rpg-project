<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'xp', 'player_class_id'];

    public function class()
    {
        return $this->belongsTo(PlayerClass::class, 'player_class_id');
    }

    public function guilds()
    {
        return $this->belongsToMany(Guild::class, 'player_guilds');
    }

    public function sessions()
    {
        return $this->belongsToMany(RpgSession::class, 'player_session', 'player_id', 'session_id');
    }
}
