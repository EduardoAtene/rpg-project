<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerGuild extends Model
{
    use HasFactory;

    protected $fillable = ['guild_id', 'player_id', 'player_xp'];

    public function guild()
    {
        return $this->belongsTo(Guild::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
