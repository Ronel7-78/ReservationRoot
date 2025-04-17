@extends('../../Template/app')

@section('Travel')
<title>Creer un compte</title>
<div class="container">
    <h2>Créer un compte Admin</h2>
    <form method="POST" action="{{ route('Admin.store') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>
        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone">
        </div>
        <button type="submit" class="btn btn-primary">Créer l'admin</button>
    </form>
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