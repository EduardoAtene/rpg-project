<?php

namespace App\Interfaces\Strategies;

interface GuildDistributionStrategyInterface
{
    public function distribute(array $players, array &$guilds): void;
}
