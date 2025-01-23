@extends('layouts.app')

@section('title', 'Editar Jogador')

@section('content')
    @component('layouts.components.form', [
        'title' => 'Editar Jogador',
        'id' => 'editPlayerForm',
        'action' => url("api/players/$player->id"),
        'method' => 'PUT',
        'fields' => [
            [
                'type' => 'text',
                'label' => 'Nome',
                'id' => 'name',
                'name' => 'name',
                'value' => $player->name,
                'placeholder' => 'Digite o nome do jogador',
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'XP',
                'id' => 'xp',
                'name' => 'xp',
                'value' => $player->xp, 
                'placeholder' => 'Digite o XP',
                'required' => true
            ],
            [
                'type' => 'select',
                'label' => 'Classe',
                'id' => 'player_class_id',
                'name' => 'player_class_id',
                'options' => [
                    '1' => 'Arqueiro',
                    '2' => 'Mago',
                    '3' => 'Guerreiro',
                    '4' => 'Clérigo'
                ],
                'selected' => $player->player_class_id,
                'required' => true,
                'disabled' => true 
            ]
        ],
        'buttons' => [
            [
                'type' => 'submit',
                'label' => 'Atualizar Jogador',
                'class' => 'btn-primary'
            ]
        ]
    ])
    @endcomponent
@endsection
