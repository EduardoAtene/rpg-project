@extends('layouts.app')

@section('title', 'Listagem de Jogadores')

@section('content')
    <h1>Listagem de Jogadores</h1>

    @component('layouts.components.button', [
        'type' => 'btn-primary',
        'onclick' => "location.href='/players/create'"
    ])
        Criar Jogador
    @endcomponent

    @component('layouts.components.table', ['columns' => ['Nome', 'XP', 'Classe', 'Ação']])
        @foreach ($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->xp }}</td>
                <td>{{ $player->class->name ?? 'Sem classe' }}</td>
                <td>
                    @component('layouts.components.button', [
                        'type' => 'btn-secondary',
                        'onclick' => "location.href='/players/{$player->id}/edit'"
                    ])
                        Editar
                    @endcomponent
                </td>
            </tr>
        @endforeach
    @endcomponent
@endsection
