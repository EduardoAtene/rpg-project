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
            color: #0d6efd;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">FlexStart</a>
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

    <div class="container my-5">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
