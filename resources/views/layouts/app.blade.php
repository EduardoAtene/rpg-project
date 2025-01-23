<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        /* Navbar Styles */
        .navbar {
            padding: 15px 30px;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: #ff0000;
        }

        .navbar-brand:hover {
            color: #084298;
        }

        .nav-link {
            color: #6c757d;
            font-weight: 500;
            padding: 10px 15px;
        }

        .nav-link:hover {
            color: #0d6efd;
        }

        .hero {
            background-color: #f8f9fa;
            text-align: center;
            padding: 80px 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: #212529;
        }

        .hero p {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .hero .btn-primary {
            margin-right: 15px;
            font-size: 1rem;
            padding: 10px 20px;
        }

        .hero .btn-secondary {
            font-size: 1rem;
            padding: 10px 20px;
        }

        /* Estilização da tabela */
.table {
    background-color: #ffffff; /* Fundo branco */
    border-collapse: separate; /* Bordas separadas */
    border-spacing: 0; /* Remove espaçamento entre bordas */
}

.table thead {
    background-color: #5a67d8; /* Cabeçalho azul */
    color: white;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.table th, .table td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
    font-size: 0.95rem;
    border: none; /* Remove as bordas padrão */
}

.table tbody tr:nth-child(odd) {
    background-color: #f9fafb; /* Fundo claro para linhas ímpares */
}

.table tbody tr:nth-child(even) {
    background-color: #e9ecef; /* Fundo ligeiramente mais escuro */
}

/* Sombra e arredondamento */
.table {
    border-radius: 12px; /* Bordas arredondadas */
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Foco ao passar o mouse */
.table-hover tbody tr:hover {
    background-color: #edf2f7; /* Fundo azul claro ao hover */
}
form {
    max-width: 600px;
    margin: auto;
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
}

form .form-label {
    font-weight: bold;
    color: #4a5568;
}

form .form-control {
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    font-size: 0.9rem;
    padding: 10px;
}

form .form-control:focus {
    box-shadow: 0 0 5px rgba(56, 178, 172, 0.8);
    border-color: #38b2ac;
}

form button {
    margin-top: 20px;
}
.modal-header.bg-danger {
    background-color: #dc3545 !important;
    color: #fff !important;
}

.modal-body ul {
    margin: 0;
    padding-left: 20px;
    color: #dc3545;
    font-weight: bold;
}

.modal-body ul li {
    margin-bottom: 5px;
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Sistema de Guildas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/sessions') }}">Sessões</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/players') }}">Jogadores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Dúvidas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @if(session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro de Validação:</strong>
            <ul class="mb-0">
                @foreach (session('errors')->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container my-5">
        @yield('content')
    </div>

        <!-- Modal para exibir erros -->
        @component('layouts.components.modal', [
            'id' => 'errorModal',
            'title' => 'Erro de Validação',
            'headerClass' => 'danger'
        ])
            <div id="errorMessages">
            </div>
        @endcomponent


    <!-- Modal para exibir erros -->
    @component('layouts.components.modal', [
        'id' => 'errorModal',
        'title' => 'Erro de Validação',
        'headerClass' => 'danger'
    ])
        <div id="errorMessages">
        </div>
    @endcomponent

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('JavaScript carregado e DOM pronto!');

            function handleFormSubmit(formId) {
                const form = document.getElementById(formId);

                if (!form) {
                    console.error(`Formulário com ID "${formId}" não encontrado!`);
                    return;
                }

                form.addEventListener('submit', async function (event) {
                    event.preventDefault();
                    console.log(`Evento submit capturado para ${formId}`);

                    const formData = new FormData(form);
                    console.log('Dados do formulário:', Object.fromEntries(formData));

                    try {
                        const response = await axios({
                            method: form.method,
                            url: form.action,
                            data: formData
                        });
                        console.log('Resposta do back-end:', response);

                        alert('Operação realizada com sucesso!');
                        window.location.href = '/players';
                    } catch (error) {
                        console.log('Erro no envio:', error);

                        if (error.response && error.response.status === 422) {
                            const errors = error.response.data.errors;

                            const errorList = Object.values(errors)
                                .map(messages => messages.map(msg => `<li>${msg}</li>`).join(''))
                                .join('');

                            const errorMessages = document.getElementById('errorMessages');
                            if (errorMessages) {
                                errorMessages.innerHTML = `<ul>${errorList}</ul>`;
                            }

                            const errorModalElement = document.getElementById('errorModal');
                            if (errorModalElement) {
                                const errorModal = new bootstrap.Modal(errorModalElement);
                                errorModal.show();
                            }
                        } else {
                            alert('Erro inesperado. Tente novamente mais tarde.');
                        }
                    }
                });
            }

            // Ativando o evento para os formulários
            handleFormSubmit('playerForm'); // Formulário de criação
            handleFormSubmit('editPlayerForm'); // Formulário de edição
        });
    </script>
</body>
</html>
