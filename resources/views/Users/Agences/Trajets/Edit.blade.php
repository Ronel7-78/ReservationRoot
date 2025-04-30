@extends('../Template.app')

@section('Travel')
<title>Editer Un Trajet -  @foreach ($trajets as $trajet) {{ $trajet->agence->nom_commercial }}@endforeach</title>
<div class="container my-5">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
           <div class="card shadow bd">
                <center class="card-header  text-dark">
                    <h4> <i class="far fa-edit text-primary"></i> Editer le Trajet <b class="text-gold">{{$trajet->ville_depart}} - {{$trajet->ville_arrivee}}</h4>
                </center>
                <div class="card-body">
                    <!-- resources/views/agence/bus/create.blade.php -->
                    <form action="{{ route('Agence.Trajet.update',$trajet->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label> <i class="fas fa-level-down-alt"></i> <b>Ville de Départ*</b></label>
                                <input type="text" name="ville_depart" class="form-control" value={{ $trajet->ville_depart }}>
                                @error('ville_depart')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label> <i class="fas fa-level-up-alt"></i> <b>Ville d'Arrivé*</b></label>
                                <input type="text" name="ville_arrivee" class="form-control" value={{ $trajet->ville_arrivee }}>
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
                                    <select name="standing" class="form-select" value={{ $trajet->standing }}>
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
                                    <input type="number" name="prix" class="form-control" min="0" value={{ $trajet->prix }}>
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
                            <button type="submit" class="btn btn-outline-success"><b>Enregistrer</b> <i class="fas fa-recycle"></i></button>

                        </center>
                        
                    </form>
                </div>
           </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>



@endsection