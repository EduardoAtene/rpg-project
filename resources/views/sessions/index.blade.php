@extends('layouts.app')

@section('title', 'Listagem de Sessões')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Listagem de Sessões</h1>
            @component('layouts.components.button', [
                'type' => 'btn-success btn-lg',
                'onclick' => "location.href='/sessions/create'"
            ])
                Criar Sessão
            @endcomponent
        </div>

        @component('layouts.components.table', [
            'columns' => ['Nome', 'Status', 'Data Início'],
            'rows' => $sessions->map(function ($session) {
                return [
                    'data' => [
                        $session->name,
                        '<span class="badge ' .
                            ($session->status === 'waiting' ? 'bg-warning' : '') .
                            ($session->status === 'in_progress' ? 'bg-primary' : '') .
                            ($session->status === 'closed' ? 'bg-success' : '') .
                            '">' .
                            ucfirst(str_replace('_', ' ', $session->status)) .
                            '</span>',
                        \Carbon\Carbon::parse($session->date_session)->format('d/m/Y') ?? 'Sem data'
                    ],
                    'onclick' => "location.href='/sessions/{$session->id}/details'"
                ];
            })->toArray()
        ])
        @endcomponent
    </div>
@endsection
