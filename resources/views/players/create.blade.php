@extends('layouts.app')

@section('title', 'Criar Jogador')

@section('content')
    <h1>Criar Novo Jogador</h1>
    <form action="/players" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="xp" class="form-label">XP</label>
            <input type="number" class="form-control" id="xp" name="xp" required>
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Classe</label>
            <select class="form-control" id="class" name="class" required>
                <option value="Arqueiro">Arqueiro</option>
                <option value="Mago">Mago</option>
                <option value="Guerreiro">Guerreiro</option>
            </select>
        </div>
        @include('layouts.components.button', ['type' => 'btn-success'])
            Salvar Jogador
        @endcomponent
    </form>
@endsection
