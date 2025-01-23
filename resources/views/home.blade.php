@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container text-center">
            <h1 class="display-4">RPG Mensal</h1>
            <p class="lead">Esse é um simulador de Guildas e balanceamento de jogadores.</p>
            @include('layouts.components.button', [
                'type' => 'btn-primary',
                'size' => 'btn-lg',
                'class' => 'me-3',
                'onclick' => '',
                'slot' => 'Sessões',
                'href' => url('/sessions')
            ])
            @include('layouts.components.button', [
                'type' => 'btn-secondary',
                'size' => 'btn-lg',
                'onclick' => '',
                'slot' => 'Jogadores',
                'href' => url('/players')
            ])
        </div>
    </section>
@endsection
