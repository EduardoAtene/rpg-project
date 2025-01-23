<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RpgSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rpg_sessions';

    protected $fillable = [
        'name',
        'date_session',
        'description',
        'status',
    ];

    protected $attributes = [
        'status' => 'waiting',
    ];
}
