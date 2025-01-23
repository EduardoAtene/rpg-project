@extends('layouts.app')
{{-- 

@section('scripts')
<script src="{{ asset('js/playerForm.js') }}"></script>
@endsection --}}

@section('title', 'Criar Jogador')

@section('content')
    @component('layouts.components.form', [
        'title' => 'Criar Novo Jogador',
        'id' => 'playerForm',
        'action' => url('api/players'),
        'method' => 'POST',
        'fields' => [
            [
                'type' => 'text',
                'label' => 'Nome',
                'id' => 'name',
                'name' => 'name',
                'placeholder' => 'Digite o nome do jogador',
                'required' => true
            ],
            [
                'type' => 'number',
                'label' => 'XP',
                'id' => 'xp',
                'name' => 'xp',
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
                'required' => true
            ]
        ],
        'buttons' => [
            [
                'type' => 'submit',
                'label' => 'Salvar Jogador',
                'class' => 'btn-success'
            ]
        ]
    ])
    @endcomponent
@endsection

