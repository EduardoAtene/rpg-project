@extends('layouts.app')

@section('title', 'Listagem de Jogadores')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Listagem de Jogadores</h1>
            @component('layouts.components.button', [
                'type' => 'btn-success btn-lg',
                'onclick' => "location.href='/players/create'"
            ])
                Criar Jogador
            @endcomponent
        </div>

        @component('layouts.components.table', ['columns' => ['Nome', 'XP', 'Classe', 'Ação']])
            @foreach ($players as $player)
                <tr>
                    <td>{{ $player->name }}</td>
                    <td>{{ $player->xp }}</td>
                    <td>{{ $player->class->name ?? 'Sem classe' }}</td>
                    <td>
                        @component('layouts.components.button', [
                            'type' => 'btn-primary btn-sm',
                            'onclick' => "location.href='/players/{$player->id}/edit'"
                        ])
                            Editar
                        @endcomponent
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
@endsection
