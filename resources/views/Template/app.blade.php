<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <style>
        .custom-nav {
            background: linear-gradient(90deg, #1a237e 0%, #0d47a1 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .navbar-brand i {
            color: #ffd700;
            margin-right: 8px;
        }
        .nav-link {
            color: #fff !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            transform: translateY(-2px);
        }
        .search-bar {
            flex-grow: 1;
            max-width: 600px;
            margin: 0 20px;
        }
        .user-greeting {
            color: #fff;
            margin-right: 15px;
            font-weight: 500;
        }
        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<div>
    <nav class="navbar navbar-expand-lg custom-nav fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">
                <i class="fas fa-plane-departure"></i>VoyageExpress
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Partie centrale -->
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <!-- Menu principal -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <!-- Menu Admin -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-tachometer-alt"></i> Administration
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-users"></i> Gestion Clients</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-building"></i> Gestion Agences</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fas fa-route"></i> Gestion Voyages</a></li>
                                        <li><a class="dropdown-item" href="{{ route('admin.agences.create') }}"><i class="fas fa-route"></i> Ajouter une  Agence</a></li>
                                    </ul>
                                </li>
                            @elseif(auth()->user()->role === 'agence')
                                <!-- Menu Agence -->
                                <li class="nav-item ">
                                    <a class="nav-link" href="{{ route('Agence.dashboard') }}" >
                                        <i class="fas fa-bus"></i> Tableau de Board
                                    </a>

                                </li>
                            @else
                                <!-- Menu Client -->
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        <i class="fas fa-search"></i> Rechercher un voyage
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        <i class="fas fa-ticket-alt"></i> Mes réservations
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Barre de recherche améliorée -->
                    <div class="search-bar">
                        <form class="d-flex">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Destination, ville..." aria-label="Search">
                                <button class="btn btn-warning" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Section utilisateur -->
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                    <span class="user-greeting me-2">
                                        @if(auth()->user()->role === 'admin')
                                            {{ auth()->user()->name }}
                                        @else
                                            {{ auth()->user()->client->prenom ?? auth()->user()->agence->nom_commercial }}
                                        @endif
                                    </span>
                                    <i class="fas fa-user-circle fs-4"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Mon compte</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt text-danger"></i> Déconnexion
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-outline-light me-2" href="{{ route('register') }}">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-warning" href="{{ route('login') }}">Connexion</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="pagin ">
    @yield('Travel')
</div>

</body>
</html>