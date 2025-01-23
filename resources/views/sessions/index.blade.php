@extends('layouts.app')

@section('title', 'Listagem de Sessões')

@section('content')
    <div class="container">
        <!-- Título e botão de criação -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Listagem de Sessões</h1>
            @component('layouts.components.button', [
                'type' => 'btn-success btn-lg',
                'onclick' => "location.href='/sessions/create'"
            ])
                Criar Sessão
            @endcomponent
        </div>

        <!-- Tabela de sessões -->
        @component('layouts.components.table', ['columns' => ['Nome', 'Status', 'Data Início', 'Ação']])
            @foreach ($sessions as $session)
                <tr>
                    <td>{{ $session->name }}</td>
                    <td>
                        <span class="badge 
                            {{ $session->status === 'waiting' ? 'bg-warning' : '' }}
                            {{ $session->status === 'in_progress' ? 'bg-primary' : '' }}
                            {{ $session->status === 'closed' ? 'bg-success' : '' }}
                        ">
                            {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($session->date_session)->format('d/m/Y') ?? 'Sem data' }}</td>
                    <td>
                        @component('layouts.components.button', [
                            'type' => 'btn-primary btn-sm',
                            'onclick' => "location.href='/sessions/{$session->id}/edit'"
                        ])
                            Editar Sessão
                        @endcomponent
                    </td>
                </tr>
            @endforeach
        @endcomponent
    </div>
@endsection
