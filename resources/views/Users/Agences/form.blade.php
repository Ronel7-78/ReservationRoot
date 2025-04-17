@extends('../Template.app')

@section('Travel')
<div class="container">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6  ">
            <div class="card shadow bd">
                    <div class="card-header bg-primary text-white">
                        <h4>Ajouter une nouvelle agence</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.agences.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nom commercial*</label>
                                        <input type="text" name="nom_commercial" class="form-control" value="{{ old('nom_commercial') }}">
                                        @error('nom_commercial')
                                            <div class="text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Logo</label>
                                        <input type="file" name="logo" class="form-control"value="{{ old('logo') }}">
                                        @error('logo')
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
                                        <label class="form-label">Email*</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Téléphone*</label>
                                        <input type="text" name="telephone" class="form-control" value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <div class="text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Localisation*</label>
                                <input type="text" name="localisation" class="form-control" value="{{ old('localisation') }}">
                                @error('localisation')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Devise/Slogan</label>
                                <input type="text" name="devise" class="form-control" value="{{ old('devise') }}">
                                @error('devise')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mot de passe temporaire*</label>
                                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                                @error('password')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
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