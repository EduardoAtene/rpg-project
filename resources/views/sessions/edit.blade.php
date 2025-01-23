@extends('layouts.app')

@section('title', 'Editar Sessão')

@section('content')
    @component('layouts.components.form', [
        'title' => 'Editar Sessão',
        'id' => 'editSessionForm',
        'action' => url("api/sessions/$session->id"),
        'method' => 'PUT',
        'fields' => [
            [
                'type' => 'text',
                'label' => 'Nome da Sessão',
                'id' => 'name',
                'name' => 'name',
                'value' => $session->name,
                'placeholder' => 'Digite o nome da sessão',
                'required' => true
            ],
            [
                'type' => 'datetime-local',
                'label' => 'Data da Sessão',
                'id' => 'date_session',
                'name' => 'date_session',
                'value' => $session->date_session ? date('Y-m-d\TH:i', strtotime($session->date_session)) : '',
                'required' => true
            ],
            [
                'type' => 'textarea',
                'label' => 'Descrição',
                'id' => 'description',
                'name' => 'description',
                'value' => $session->description,
                'placeholder' => 'Digite os detalhes da sessão',
                'required' => true
            ],
            [
                'type' => 'select',
                'label' => 'Status',
                'id' => 'status',
                'name' => 'status',
                'options' => [
                    'waiting' => 'Aguardando',
                    'in_progress' => 'Em Andamento',
                    'closed' => 'Finalizada'
                ],
                'selected' => $session->status,
                'required' => true
            ]
        ],
        'buttons' => [
            [
                'type' => 'submit',
                'label' => 'Atualizar Sessão',
                'class' => 'btn-primary'
            ]
        ]
    ])
    @endcomponent
@endsection
