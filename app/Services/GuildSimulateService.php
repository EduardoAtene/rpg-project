<?php

namespace App\Services;

use App\Exceptions\RpgSessionNotFoundException;
use App\Exceptions\ValidateException;
use App\Interfaces\Repositories\RpgSessionInterface;

;
use App\Repositories\PlayerSessionRepository;

class GuildSimulateService
{
    protected RpgSessionInterface $rpgSessionRepository;
    protected PlayerSessionRepository $playerSessionRepository;

    public function __construct(
        RpgSessionInterface $rpgSessionRepository,
        PlayerSessionRepository $playerSessionRepository
    )
    {
        $this->rpgSessionRepository = $rpgSessionRepository;
        $this->playerSessionRepository = $playerSessionRepository;
    }

    public function simulate(array $validatedData): array
    {
        $rpgSession = $this->getRpgSession($validatedData['session_id']);

        $this->validateStatusRpgSession($rpgSession);

        $playerAssociate = $this->playerSessionRepository->getAllPlayersAssociateSession($rpgSession->id);
    
        $this->validateRuleGuilds($validatedData,$playerAssociate);

        $guilds = $validatedData['guilds'];
        $data = [];

        foreach ($guilds as $guild) {
            $players = [
                [
                    "id" => 1,
                    "name" => "Jogador 1",
                    "xp" => 120,
                    "class" => "Guerreiro",
                ],
                [
                    "id" => 2,
                    "name" => "Jogador 2",
                    "xp" => 80,
                    "class" => "Mago",
                ],
            ];

            $totalXp = array_sum(array_column($players, 'xp'));

            $data[] = [
                'guild_name' => $guild['name'],
                'players' => $players,
                'total_xp' => $totalXp,
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Simulação de guildas concluída com sucesso.',
            'data' => $data,
        ];
    }

    public function confirm(array $validatedData): array
    {
        //
        return [
            'status' => 'success',
            'message' => 'Confirmação de guildas concluída com sucesso.',
            'data' => $this->simulate($validatedData)['data'],
        ];
    }

    private function getRpgSession(int $sessionId): object
    {
        $session = $this->rpgSessionRepository->getById($sessionId);
        if (!$session) {
            throw new RpgSessionNotFoundException("A sessão de rpg  com o ID {$sessionId} não foi encontrada.");
        }

        return $session;
    }

    private function validateStatusRpgSession(object $rpgSession): void
    {
        if ($rpgSession->status === 'waiting') {
            throw new ValidateException("A sessão de rpg com o ID {$rpgSession->id} ainda nao iniciou.");
        }

        if ($rpgSession->status === 'closed') {
            throw new ValidateException("A sessão de rpg com o ID {$rpgSession->id} ja foi fechada.");
        }
    }

    private function validateRuleGuilds(array $validatedData, object $playerSession): void
    {

        $this->validateQntGuildsByQntPlayers($validatedData, $playerSession->count());

        foreach ($playerSession as $player) {
            if ($player->status !== 'attend') {
                throw new ValidateException("O jogador {$player->id} nao esta presente.");
            }
            
        }
    }

    private function validateQntGuildsByQntPlayers(array $validatedData, int $qntPlayers): void
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
            throw new ValidateException("A soma de jogadores em todas as guildas que é {$totalPlayerCount} não pode exceder o número de jogadores disponíveis {$qntPlayers}.");
        }


    }
}
