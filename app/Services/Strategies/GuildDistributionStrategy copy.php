<?php

namespace App\Services\Strategies;

use App\Interfaces\Strategies\GuildDistributionStrategyInterface;

class GuildDistributionStrategy implements GuildDistributionStrategyInterface
{
    public function distribute(array $players, array &$guilds): void
    {
        $classes = [
            1 => 'Guerreiro',
            2 => 'Mago',
            3 => 'Arqueiro',
            4 => 'Clérigo',
        ];

        $playersGroupedByClass = collect($players)->groupBy(fn($player) => $player['class']['id'])->toArray();

        $suportGroup = $playersGroupedByClass[4] ?? [];
        $warriorGroup = $playersGroupedByClass[1] ?? [];
        $rangedGroup = array_merge(
            $playersGroupedByClass[2] ?? [],
            $playersGroupedByClass[3] ?? []
        );

        foreach ($guilds as &$guild) {
            $guild['players'] = [];
            $guild['missing_classes'] = [];

            if (!empty($suportGroup)) {
                $guild['players'][] = array_shift($suportGroup);
            } else {
                $guild['missing_classes'][] = $classes[4];
            }

            if (!empty($warriorGroup)) {
                $guild['players'][] = array_shift($warriorGroup);
            } else {
                $guild['missing_classes'][] = $classes[1];
            }

            if (!empty($rangedGroup)) {
                $guild['players'][] = array_shift($rangedGroup);
            } else {
                $guild['missing_classes'][] = 'Ataque à Distância (' . $classes[2] . ' ou ' . $classes[3] . ')';
            }

            while (count($guild['players']) < $guild['qnt_players']) {
                if (!empty($suportGroup)) {
                    $guild['players'][] = array_shift($suportGroup);
                } elseif (!empty($warriorGroup)) {
                    $guild['players'][] = array_shift($warriorGroup);
                } elseif (!empty($rangedGroup)) {
                    $guild['players'][] = array_shift($rangedGroup);
                } else {
                    break;
                }
            }

            $guild['total_xp'] = array_sum(array_column($guild['players'], 'xp'));
        }
    }
}
