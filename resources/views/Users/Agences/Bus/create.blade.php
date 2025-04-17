@extends('../Template.app')

@section('Travel')
<title>Ajouter un Bus-Agence</title>
<div class="container my-5">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
           <div class="card shadow bd">
                <div class="card-header bg-primary text-white">
                    <h4>Ajouter un Bus</h4>
                </div>
                <div class="card-body">
                    <!-- resources/views/agence/bus/create.blade.php -->
                    <form action="{{ route('Agence.Bus.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Immatriculation*</label>
                            <input type="text" name="immatriculation" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Type de bus*</label>
                                    <select name="type" class="form-select" required>
                                        <option value="vip">VIP</option>
                                        <option value="standard">Standard</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Nombre de places*</label>
                                    <input type="number" name="nombre_place" class="form-control" min="1" required>
                                </div>
                            </div>
                        </div>
                        <!-- resources/views/agence/bus/create.blade.php -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Photo extérieure*</label>
                                <input type="file" name="photo_exterieur" class="form-control" accept="image/*" required>
                                <small class="text-muted">Format: JPEG/PNG, Max: 2MB</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Photo intérieure</label>
                                <input type="file" name="photo_interieur" class="form-control" accept="image/*">
                                <small class="text-muted">Optionnel</small>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
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