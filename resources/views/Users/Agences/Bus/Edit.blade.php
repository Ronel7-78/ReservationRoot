@extends('../Template.app')

@section('Travel')
<title>Ajouter un Bus-Agence</title>
<div class="container my-5">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
           <div class="card shadow bd">
                <center class="card-header my-2">
                    <b class="h4">Modifier le bus <b class="text-dark">{{$bus->immatriculation}}</b></b>
                </center>
                <div class="card-body">
                    <!-- resources/views/agence/bus/create.blade.php -->
                    <form action="{{ route('Agence.Bus.Update',$bus->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label><i class="fas fa-align-left"></i> <b>Libelle*</b></label>
                            <input type="text" name="libelle" class="form-control" value={{ $bus->libelle }}>
                            @error('libelle')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><i class="fas fa-barcode"></i> <b>Immatriculation*</b></label>
                                    <input type="text" name="immatriculation" class="form-control" value={{ $bus->immatriculation}}>
                                    @error('immatriculation')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label><i class="fab fa-autoprefixer"></i> <b>Agence*</b></label>
                                    <select name="agence_id" class="form-select" readonly>
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
                                    <label><i class="fas fa-bus-alt"></i> <b>Type de bus*</b></label>
                                    <select name="type" class="form-select" value={{ $bus->type}}>
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
                                    <label> <i class="fas fa-grip-horizontal"></i> <b>Nombre de places*</b></label>
                                    <input type="number" name="nombre_place" class="form-control" min="1" value={{ $bus->nombre_place }}>
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
                                <label><i class="fas fa-camera-retro"></i> <b>Photo extérieure*</b></label>
                                <input type="file" name="photo_exterieur" class="form-control" accept="image/*" value={{ $bus->photo_exterieur }}>
                                <small class="text-muted">Format: JPEG/PNG, Max: 2MB</small>
                                @error('photo_exterieur')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label> <i class="fas fa-camera"></i> <b>Photo intérieure</b></label>
                                <input type="file" name="photo_interieur" class="form-control" accept="image/*" value={{ $bus->photo_interieur }}>
                                <small class="text-muted">Optionnel</small>
                                @error('photo_interieur')
                                    <div class="text text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <center class="my-2">
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