@extends('../../Template/app')

@section('Travel')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #f39c12;
        --hover-color: #34495e;
    }

    .admin-sidebar {
        background: var(--primary-color);
        min-height: 100vh;
        width: 250px;
        transition: all 0.3s;
    }

    .admin-main {
        flex: 1;
        background: #f8f9fa;
    }

    .stat-card {
        border: none;
        border-radius: 10px;
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .activity-item {
        border-left: 3px solid var(--secondary-color);
        transition: background 0.3s;
    }

    .activity-item:hover {
        background: #f8f9fa;
    }

    .nav-link-custom {
        color: #ecf0f1 !important;
        border-radius: 5px;
    }

    .nav-link-custom:hover {
        background: var(--hover-color);
    }
</style>

<title>Tableau de Bord Admin</title>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="admin-sidebar p-3 text-white">
        <h3 class="mb-4"><i class="fas fa-user-shield me-2"></i>Admin Panel</h3>

        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link nav-link-custom" href="#">
                    <i class="fas fa-building me-2"></i>Agences
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link nav-link-custom" href="{{ route('admin.agences.create') }}">
                    <i class="fas fa-plus-circle me-2"></i>Créer Agence
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link nav-link-custom" href="#">
                    <i class="fas fa-user-plus me-2"></i>Créer Admin
                </a>
            </li>
        </ul>

        <hr class="bg-secondary">

        <h5 class="mt-4"><i class="fas fa-building me-2"></i>Dernières Agences</h5>
        <ul class="list-unstyled">
            @foreach($agences as $agence)
            <li class="d-flex align-items-center mb-2 p-2 bg-hover">
                <i class="fas fa-chevron-right me-2 text-secondary"></i>
                {{ Str::limit($agence->nom_commercial, 20) }}
            </li>
            @endforeach
        </ul>
    </div>

    <!-- Main Content -->
    <div class="admin-main p-4">
        <h1 class="mb-4 text-primary"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</h1>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stat-card bg-white p-4 shadow">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted">Agences</h5>
                            <h2 class="text-primary">{{ $agenceCount }}</h2>
                        </div>
                        <i class="fas fa-building fa-3x text-primary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card bg-white p-4 shadow">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted">Clients</h5>
                            <h2 class="text-success">{{ $clientCount }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x text-success"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card bg-white p-4 shadow">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted">Réservations</h5>
                            <h2 class="text-warning">{{ $reservationCount }}</h2>
                        </div>
                        <i class="fas fa-ticket-alt fa-3x text-warning"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card bg-white p-4 shadow">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="text-muted">Admins</h5>
                            <h2 class="text-danger">{{ $adminCount }}</h2>
                        </div>
                        <i class="fas fa-user-shield fa-3x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Activités Récentes</h5>
            </div>
            <div class="card-body">
                @foreach($activities as $activity)
                <div class="activity-item mb-3 p-3">
                    <div class="d-flex align-items-center">
                        <div class="icon-container me-3">
                            <i class="{{ $activity['icon'] }} fa-lg text-secondary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ $activity['title'] }}</h6>
                            <small class="text-muted">{{ $activity['date']->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@endsection