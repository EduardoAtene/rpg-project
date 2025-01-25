<?php

namespace App\Services\Validation;

use App\Exceptions\ValidateException;

class GuildValidationService
{
    public function validateStatusPlayers($playerSession): void
    {
        foreach ($playerSession as $player) {
            if ($player->status !== 'attend') {
                throw new ValidateException("O jogador {$player->id} não está presente.");
            }
        }
    }

    public function validateQntGuildsByQntPlayers(array $validatedData, int $qntPlayers): void
    {
        if ($validatedData['qnt_guilds'] > $qntPlayers) {
            throw new ValidateException("O número de guildas deve ser menor ao número de jogadores presentes.");
        }

        $qntMinGuilds = intdiv($qntPlayers, $validatedData['qnt_guilds']);
        if ($qntMinGuilds < 3) {
            throw new ValidateException("Cada guilda precisa de pelo menos 3 jogadores. Quantidade mínima de guildas que é possível é de {$qntMinGuilds} guildas.");
        }

        $totalPlayerCount = array_sum(array_column($validatedData['guilds'], 'player_count'));

        if ($totalPlayerCount > $qntPlayers) {
            throw new ValidateException("A soma de jogadores em todas as guildas ({$totalPlayerCount}) não pode exceder o número de jogadores disponíveis ({$qntPlayers}).");
        }
    }
}
