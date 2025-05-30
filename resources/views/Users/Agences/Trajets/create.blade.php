@extends('../Template.app')

@section('Travel')
<title>Ajouter un Trajet - </title>
<div class="container my-5">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
           <div class="card shadow bd">
                <center class="card-header  text-dark my-3">
                    <b class="h4"> <i class="far fa-calendar-plus text-success"></i> Ajouter un Trajet</b>
                </center>
                <div class="card-body">
                    <!-- resources/views/agence/bus/create.blade.php -->
                    <form action="{{ route('Agence.Trajet.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label> <i class="fas fa-level-down-alt"></i> <b>Ville de Départ*</b></label>
                                <input type="text" name="ville_depart" class="form-control" value={{ old('ville_depart') }}>
                                @error('ville_depart')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label> <i class="fas fa-level-up-alt"></i> <b>Ville d'Arrivé*</b></label>
                                <input type="text" name="ville_arrivee" class="form-control" value={{ old('ville_arrivee') }}>
                                @error('ville_arrivee')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <input type="hidden" name="agence_id" value="{{ auth()->user()->agence->id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><i class="fas fa-chart-line"></i> <b>Standing*</b></label>
                                    <select name="standing" class="form-select" value={{ old('standing') }}>
                                        <option value="vip">VIP</option>
                                        <option value="classique">Classique</option>
                                    </select>
                                    @error('standing')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><i class="fab fa-bitcoin"></i> <b>Prix*</b></label>
                                    <input type="number" name="prix" class="form-control" min="0" value={{ old('prix') }}>
                                    @error('prix')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-outline-danger"><b>Annuler</b> <i class="far fa-times-circle"></i></button>
                            <button type="submit" class="btn btn-outline-success"><b>Enregistrer</b> <i class="far fa-save"></i></button>

                        </center>
                    </form>
                </div>
           </div>
        </div>
        <div class="col-md-3"></div>
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