<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerClass extends Model
{
    protected $table = 'player_class';

    protected $fillable = ['name'];

    public function players()
    {
        return $this->hasMany(Player::class, 'player_class_id');
    }
}
