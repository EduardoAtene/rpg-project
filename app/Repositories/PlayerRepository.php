<?php

namespace App\Repositories;

use App\Interfaces\PlayerInterface;
use App\Models\Player;

class PlayerRepository implements PlayerInterface
{
    protected $player;
    
    public function __construct(Player $player)
    {
        $this->player = $player;
    }
    
    public function index()
    {
        $players = $this->player::all();

        return $players;
    }
    
    public function store($data)
    {
        $player = $this->player::create($data);

        return $player;
    }
    
    public function show($id)
    {
        // $player = $this->player::findOrFail($id);
        // return $player;
    }
    
    public function update($data, $id)
    {
        // $player = $this->player::findOrFail($id);
        // $player->fill($data);
        // $player->save();
        // return $player;
    }
    
    public function destroy($id)
    {
        $player = $this->player::findOrFail($id);
        $player->delete();

        return $player;
    }
}
