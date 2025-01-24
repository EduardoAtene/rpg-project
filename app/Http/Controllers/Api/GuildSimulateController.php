<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GuildSimulateController extends Controller
{
    public function simulate(Request $request): JsonResponse
    {
        // Corpo de exemplo para a resposta
        $response = [
            "status" => "success",
            "message" => "Simulação de guildas concluída com sucesso.",
            "data" => [
                [
                    "guild_name" => "Guilda A",
                    "players" => [
                        [
                            "id" => 1,
                            "name" => "Jogador 1",
                            "xp" => 120,
                            "class" => "Guerreiro"
                        ],
                        [
                            "id" => 2,
                            "name" => "Jogador 2",
                            "xp" => 80,
                            "class" => "Mago"
                        ]
                    ],
                    "total_xp" => 200
                ],
                [
                    "guild_name" => "Guilda B",
                    "players" => [
                        [
                            "id" => 3,
                            "name" => "Jogador 3",
                            "xp" => 90,
                            "class" => "Arqueiro"
                        ],
                        [
                            "id" => 4,
                            "name" => "Jogador 4",
                            "xp" => 110,
                            "class" => "Clérigo"
                        ]
                    ],
                    "total_xp" => 200
                ]
            ]
        ];

        return response()->json($response);
    }

    public function confirm(Request $request): JsonResponse
    {
        // Corpo de exemplo para a resposta
        $response = [
            "status" => "success",
            "message" => "Confirmação de guildas concluída com sucesso.",
            "data" => [
                [
                    "guild_name" => "Guilda A",
                    "players" => [
                        [
                            "id" => 1,
                            "name" => "Jogador 1",
                            "xp" => 120,
                            "class" => "Guerreiro"
                        ],
                        [
                            "id" => 2,
                            "name" => "Jogador 2",
                            "xp" => 80,
                            "class" => "Mago"
                        ]
                    ],
                    "total_xp" => 200
                ],
                [
                    "guild_name" => "Guilda B",
                    "players" => [
                        [
                            "id" => 3,
                            "name" => "Jogador 3",
                            "xp" => 90,
                            "class" => "Arqueiro"
                        ],
                        [
                            "id" => 4,
                            "name" => "Jogador 4",
                            "xp" => 110,
                            "class" => "Clérigo"
                        ]
                    ],
                    "total_xp" => 200
                ]
            ]
        ];

        return response()->json($response);
    }
}
