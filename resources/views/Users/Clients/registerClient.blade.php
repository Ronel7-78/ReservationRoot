<!-- resources/views/auth/register-client.blade.php -->
@extends('../Template.app')

@section('Travel')
<title>Client-Inscription</title>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Inscription Client</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
                                    @error('nom')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}">
                                    @error('prenom')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" >
                                    @error('password')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label"> <i class="fas fa-american-sign-language-interpreting"></i> <b>Sexe</b></label>
                                <select class="form-select" name="sexe" id="sexe" value="{{ old('sexe') }}">
                                    <option value="">Choisir le genre...</option>
                                    <option value="Masculin"> Masculin</option>
                                    <option value="Feminin"> Feminin</option>

                                </select>
                                @error('sexe')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone</label>
                                    <input type="tel" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cni" class="form-label">Numéro CNI/Récepissé</label>
                                    <input type="text" class="form-control" id="cni" name="cni" value="{{ old('cni') }}">
                                    @error('cni')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <center class="my-2">
                            <button type="submit" class="btn btn-outline-danger "><b>Cancel</b></button>
                            <button type="submit" class="btn btn-outline-primary "><b>S'inscrire</b></button>
                        </center>
                    </form>
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