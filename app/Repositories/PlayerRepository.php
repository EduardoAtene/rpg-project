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
        return $this->player::with('class')->get();
    }
    
    public function store($data)
    {
        return $this->player::create($data);
    }
    
    public function show($id)
    {
        return $this->player::with('class')->findOrFail($id);
    }
    
    public function update($data, $id)
    {
        $player = $this->player::findOrFail($id);
        $player->update($data);

        return $player;
    }
    
    public function destroy($id)
    {
        $player = $this->player::findOrFail($id);
        $player->delete();

        return $player;
    }
}
