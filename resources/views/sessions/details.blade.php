@extends('layouts.app')

@section('title', 'Detalhes da Sessão')

@section('content')
    <div class="container">
        <h1 class="display-6 mb-4">Detalhes da Sessão</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <h3 class="card-title">{{ $session->name }}</h3>
                <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $session->status)) }}</p>
                <p><strong>Data de Início:</strong> {{ \Carbon\Carbon::parse($session->date_session)->format('d/m/Y') }}</p>
                <p><strong>Descrição:</strong> {{ $session->description }}</p>
            </div>
        </div>

        @component('layouts.components.button', [
            'type' => 'btn-primary btn-lg',
            'onclick' => "location.href='/sessions/{$session->id}/edit'"
        ])
            Editar Sessão
        @endcomponent
    </div>
@endsection
