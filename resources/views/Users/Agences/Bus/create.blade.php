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
                    <form action="{{ route('Agence.Bus.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Libelle*</label>
                            <input type="text" name="libelle" class="form-control" value={{ old('libelle') }}>
                            @error('libelle')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Immatriculation*</label>
                                    <input type="text" name="immatriculation" class="form-control" value={{ old('immatriculation') }}>
                                    @error('immatriculation')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Agence*</label>
                                    <select name="agence_id" class="form-select">
                                        @foreach($agences as $agence)
                                            <option value="{{ $agence->id }}">
                                                {{ $agence->nom_commercial }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('agence_id')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Type de bus*</label>
                                    <select name="type" class="form-select" value={{ old('type') }}>
                                        <option value="vip">VIP</option>
                                        <option value="standard">Standard</option>
                                    </select>
                                    @error('type')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Nombre de places*</label>
                                    <input type="number" name="nombre_place" class="form-control" min="1" value={{ old('nombre_place') }}>
                                    @error('nombre_place')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- resources/views/agence/bus/create.blade.php -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Photo extérieure*</label>
                                <input type="file" name="photo_exterieur" class="form-control" accept="image/*" value={{ old('photo_exterieur') }}>
                                <small class="text-muted">Format: JPEG/PNG, Max: 2MB</small>
                                @error('photo_exterieur')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Photo intérieure</label>
                                <input type="file" name="photo_interieur" class="form-control" accept="image/*">
                                <small class="text-muted">Optionnel</small>
                                @error('photo_interieur')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
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