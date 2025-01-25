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

        $playersGroupedByClass = $this->groupPlayersByClass($players);

        $suportGroup = $this->selectionSortPlayersByXp($playersGroupedByClass[4] ?? []);
        $warriorGroup = $this->selectionSortPlayersByXp($playersGroupedByClass[1] ?? []);
        $rangedGroup = $this->selectionSortPlayersByXp(array_merge(
            $playersGroupedByClass[2] ?? [],
            $playersGroupedByClass[3] ?? []
        ));

        foreach ($guilds as &$guild) {
            $guild['players'] = [];
            $guild['missing_classes'] = [];

            $this->distributeByClass($suportGroup, $guild, $classes[4], $guild['missing_classes']);
            $this->distributeByClass($warriorGroup, $guild, $classes[1], $guild['missing_classes']);
            $this->distributeByClass($rangedGroup, $guild, 'Falta alguem de Distância (' . $classes[2] . ' ou ' . $classes[3] . ')', $guild['missing_classes']);
        }

        foreach ($guilds as &$guild) {
            $this->distributePlayersToGuild($suportGroup, $warriorGroup, $rangedGroup, $guild);
            $guild['total_xp'] = array_sum(array_column($guild['players'], 'xp'));
        }

        $remainingPlayers = array_merge($suportGroup, $warriorGroup, $rangedGroup);
        $this->balanceXp($remainingPlayers, $guilds);
    }

    private function groupPlayersByClass(array $players): array
    {
        return collect($players)->groupBy(fn($player) => $player['class']['id'])->toArray();
    }

    private function selectionSortPlayersByXp(array $players): array
    {
        $count = count($players);
        for ($i = 0; $i < $count - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < $count; $j++) {
                if ($players[$j]['xp'] < $players[$minIndex]['xp']) {
                    $minIndex = $j;
                }
            }

            if ($minIndex !== $i) {
                $temp = $players[$i];
                $players[$i] = $players[$minIndex];
                $players[$minIndex] = $temp;
            }
        }

        return $players;
    }

    private function distributeByClass(array &$group, array &$guild, string $className, array &$missingClasses): void
    {
        if (!empty($group)) {
            $guild['players'][] = array_shift($group);
        } else {
            $missingClasses[] = $className;
        }
    }

    private function distributePlayersToGuild(array &$suportGroup, array &$warriorGroup, array &$rangedGroup, array &$guild): void
    {
        while (count($guild['players']) < $guild['qnt_players']) {
            if (!empty($suportGroup)) {
                $guild['players'][] = array_shift($suportGroup);

                continue;
            }
    
            if (!empty($warriorGroup)) {
                $guild['players'][] = array_shift($warriorGroup);

                continue;
            }
    
            if (!empty($rangedGroup)) {
                $guild['players'][] = array_shift($rangedGroup);

                continue;
            }
    
            return;
        }
    }

    private function balanceXp(array $players, array &$guilds): void
    {
        $players = $this->selectionSortPlayersByXp($players);

        foreach ($players as $player) {
            usort($guilds, fn($a, $b) => ($a['total_xp'] ?? 0) <=> ($b['total_xp'] ?? 0));

            $guilds[0]['players'][] = $player;
            $guilds[0]['total_xp'] = array_sum(array_column($guilds[0]['players'], 'xp'));
        }
    }
}
