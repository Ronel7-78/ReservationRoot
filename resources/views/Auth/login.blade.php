@extends('../../Template.app')

@section('Travel')
<title>Login-Form</title>
<!-- Login Form -->
<div class="container py-5">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body p-3">
                    <h2 class="text-center mb-3"><b>Connexion</b></h2>
                    <hr class="my-4">
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <center class="mt-2">
                            <button type="reset" class="btn btn-danger"><b>Annuler</b></button>
                            <button type="submit" class="btn btn-primary"><b>Se connecter</b></button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

@if (session()->has('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: "{{ session('success') }}",
            timer: 3000
        });
    });
</script>
@endif

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            html: `@foreach ($errors->all() as $error){{ $error }}<br>@endforeach`
        });
    });
</script>
@endif
@endsection