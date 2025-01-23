@extends('layouts.app')

@section('title', 'Sessão Detalhes')

@section('content')
    <div class="container">
        <!-- Detalhes da Sessão -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Sessão {{ $session->id }} - {{ $session->name }}</h2>
                <p class="mb-1"><strong>Data Início:</strong> {{ \Carbon\Carbon::parse($session->date_session)->format('d/m/Y') }}</p>
                <p class="mb-3"><strong>Data Final:</strong> {{ \Carbon\Carbon::parse($session->date_end)->format('d/m/Y') }}</p>
                <p><strong>Descrição:</strong> {{ $session->description }}</p>
                <div class="d-flex justify-content-end">
                    @if($session->status === 'waiting')
                        @component('layouts.components.button', [
                            'type' => 'btn-primary',
                            'onclick' => "alert('Iniciar Sessão ainda em desenvolvimento');"
                        ])
                            Iniciar Sessão
                        @endcomponent
                    @else
                        <span class="badge bg-success">Sessão em andamento</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Jogadores da Sessão -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="card-title">Jogadores da Sessão</h4>
                    @component('layouts.components.button', [
                        'type' => 'btn-success',
                        'onclick' => "alert('Adicionar Jogador em desenvolvimento')"
                    ])
                        Adicionar Jogador
                    @endcomponent
                </div>

                @component('layouts.components.table', ['columns' => ['Nome', 'Classe', 'Ação']])
                    @foreach ($session->players as $player)
                        <tr>
                            <td>{{ $player->name }}</td>
                            <td>{{ $player->class->name ?? 'Sem classe' }}</td>
                            <td>
                                @component('layouts.components.button', [
                                    'type' => 'btn-danger btn-sm',
                                    'onclick' => "alert('Remover Jogador em desenvolvimento')"
                                ])
                                    Remover Jogador
                                @endcomponent
                            </td>
                        </tr>
                    @endforeach
                @endcomponent
            </div>
        </div>
    </div>
@endsection
