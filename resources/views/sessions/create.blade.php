@extends('layouts.app')

@section('title', 'Criar Sessão')

@section('content')
    @component('layouts.components.form', [
        'title' => 'Criar Nova Sessão',
        'id' => 'sessionForm',
        'action' => url('api/sessions'),
        'method' => 'POST',
        'fields' => [
            [
                'type' => 'text',
                'label' => 'Nome da Sessão',
                'id' => 'name',
                'name' => 'name',
                'placeholder' => 'Digite o nome da sessão',
                'required' => true
            ],
            [
                'type' => 'date',
                'label' => 'Data da Sessão',
                'id' => 'date_session',
                'name' => 'date_session',
                'required' => true
            ],
            [
                'type' => 'textarea',
                'label' => 'Detalhes da Sessão',
                'id' => 'description',
                'name' => 'description',
                'placeholder' => 'Descreva os detalhes da sessão...',
                'rows' => 5,
                'required' => true
            ]
        ],
        'buttons' => [
            [
                'type' => 'submit',
                'label' => 'Salvar Sessão',
                'class' => 'btn-success'
            ]
        ]
    ])
    @endcomponent
@endsection
