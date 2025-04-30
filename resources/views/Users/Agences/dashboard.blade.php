@extends('../Template.app')

@section('Travel')
<title>Dasbord-Agences</title>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" href="#">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Tableau de bord
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('Agence.Trajets.index') }}">
                            <i class="fas fa-route me-2"></i>
                            Gérer les trajets
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('Agence.Bus.index') }}">
                            <i class="fas fa-bus me-2"></i>
                            Gérer les bus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('Agence.Voyages.index') }}">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Planifier un voyage
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Statistiques -->
            <div class="row my-4">
                <div class="col-md-3 col-6">
                    <div class="card bg-primary text-white shadow-lg">
                        <div class="card-body">
                            <h5><i class="fas fa-bus"></i> Bus</h5>
                            <h2 class="mb-0"><b>{{$totalBuses}}</b></h2>
                            <small>Dont <b>{{$availableBuses}}</b> disponibles</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <div class="card bg-success text-white shadow-lg">
                        <div class="card-body">
                            <h5><i class="fas fa-route"></i> Trajets</h5>
                            <h2 class="mb-0"><b>{{$activeTrajets}}</b></h2>
                            <small> Actifs</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6 mt-3 mt-md-0">
                    <div class="card bg-info text-white shadow-lg">
                        <div class="card-body">
                            <h5><i class="fas fa-ticket-alt"></i> Réservations</h5>
                            <h2 class="mb-0">234</h2>
                            <small>Ce mois</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6 mt-3 mt-md-0">
                    <div class="card bg-warning text-dark shadow-lg">
                        <div class="card-body">
                            <h5><i class="fas fa-coins"></i> Revenus</h5>
                            <h2 class="mb-0">5.4M</h2>
                            <small>FCFA ce mois</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions Rapides -->
            <div class="row my-5">
                <div class="col-12">
                    <h3 class="mb-4"><i class="fas fa-bolt me-2"></i>Actions rapides</h3>
                    <div class="d-grid gap-3 d-md-flex justify-content-md-start">
                        <a href="{{ route('Agence.Trajet.create') }}" class="btn btn-lg btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Nouveau trajet
                        </a>
                        <a href="{{ route('Agence.Bus.create') }}" class="btn btn-lg btn-success">
                            <i class="fas fa-bus me-2"></i>Ajouter un bus
                        </a>
                        <a href="{{ route('Agence.Voyage.create') }}" class="btn btn-lg btn-info text-white">
                            <i class="fas fa-calendar-plus me-2"></i>Créer voyage
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dernières activités -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Activités récentes (24 dernières heures)</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                
                                @foreach ($voyagesConfirnes as $voyage)
                                <li class="list-group-item">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Voyage #{{ $voyage->id }} confirmé ({{ $voyage->lieu_depart }} - {{ $voyage->lieu_arrivee }})
                                </li>

                                @endforeach
                                <li class="list-group-item">
                                    <i class="fas fa-bus text-primary me-2"></i>
                                    Nouveau bus enregistré (Immatriculation: LT-234-AB)
                                </li>
                                <li class="list-group-item">
                                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                    2 réservations annulées
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    #sidebar {
        min-height: 100vh;
        box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    }

    .card {
        border: none;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .btn-lg {
        padding: 1rem 2rem;
        border-radius: 15px;
    }

    .list-group-item {
        border-left: 3px solid transparent;
        transition: all 0.3s;
    }

    .list-group-item:hover {
        border-left-color: #0d6efd;
        background: #f8f9fa;
    }
</style>
@if ($errors->any())
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           // Récupère toutes les erreurs de validation
           let errors = @json($errors->all());
           // Affiche chaque erreur dans une alerte SweetAlert
           errors.forEach(function(message) {
               swal("Erreur", message, "error");
           });
       });
   </script>
   @endif

   @if (session()->has('success'))
   <script>
       document.addEventListener('DOMContentLoaded', function() {
           swal("Succès", "{{ session('success') }}", "success");
       });
   </script>
@endif
@endsection