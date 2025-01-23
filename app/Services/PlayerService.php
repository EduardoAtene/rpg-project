<?php
namespace App\Services;

use App\Interfaces\PlayerInterface;

class PlayerService
{
    protected PlayerInterface $player ;
    
    public function __construct(PlayerInterface $player)
    {
        $this->player = $player;
    }
    
    public function index()
    {
        $players = $this->player->index();

        return $players;
    }
    
    public function store($data)
    {
        $player = $this->player->store($data);

        return $player;
    }
    
    public function show($id)
    {
        $player = $this->player->show($id);

        return $player;
    }
    
    public function update($data, $id)
    {
        $player = $this->player->update($data, $id);

        return $player;
    }
    
    public function destroy($id)
    {
        $player = $this->player->destroy($id);
        
        return $player;
    }
}