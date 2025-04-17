@extends('../../Template/app')

@section('Travel')


<title>Tableau de Bord</title>

    <div class="container ">
            <!-- Dashboard -->
        <div id="" >
            <center class=" h2 text-navy "> <b>Tableau de Bord</b> </center>
            <hr >
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card bg-navy text-white transition6">
                        <div class="card-body">
                            <h5 class="card-title text-center"><i class="fas fa-money-check-alt"></i> <b>Finances</b></h5>
                            <p class="card-text display-6 text-center">
                                <b>
                                    <i>12</i>
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gold text-white transition4">
                        <div class="card-body">
                            <h5 class="card-title text-center"><i class="fas fa-layer-group"></i> <b>Formations</b></h5>
                            <p class="card-text display-6 text-center">
                                <b>
                                    <i>2</i>
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-navy text-white transition1">
                        <div class="card-body">
                            <h5 class="card-title  text-center"> <i class="fas fa-users"></i> <b>Étudiants</b></h5>
                            <p class="card-text display-6  text-center">
                                <b>
                                    <i>2</i>
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-gold text-white transition4">
                        <div class="card-body">
                            <h5 class="card-title text-center"><i class="fas fa-user-tag"></i> <b>Clients</b></h5>
                            <p class="card-text display-6 text-center">
                                <b>
                                    <i>3</i>
                                </b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="statsChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-navy text-center">Activités Récentes</h5>
                            <hr class="text-navy my-0">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" id="recentFormations"><b>9</b> nouvelle (s) formation(s) ajoutée(s)</li>
                                <li class="list-group-item" id="newEtudiants"><b>7</b> nouvel(s) étudiant(s) inscrit(s)</li>
                                <li class="list-group-item" id="newClients"><b>10 </b> nouveau(x) client(s) inscrit(s)</li>
                                <li class="list-group-item">5 nouvelle(s) opération(s) effectuée(s)</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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