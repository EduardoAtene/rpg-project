<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'session_id', 'total_xp', 'level', 'created_at', 'updated_at','deleted_at'];

    public function players()
    {
        return $this->belongsToMany(Player::class, 'player_guilds');
    }
}
