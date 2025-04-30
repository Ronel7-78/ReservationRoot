@extends('../Template.app')

@section('Travel')
<title>Liste des Bus</title>
<div class="row g-3 my-5 ">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-route me-2"></i>Liste des Bus  </h4>
            </div>
            <div class="card-body bd">
                <table id="busTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Immatriculation</th>
                            <th>Libellé</th>
                            <th>Type</th>
                            <th>Capacité</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($buses as $bus)
                        <tr>
                            <td>{{ $bus->immatriculation }}</td>
                            <td>{{ $bus->libelle }}</td>
                            <td>{{ ucfirst($bus->type) }}</td>
                            <td>{{ $bus->nombre_place }} places</td>

                            <td>

                                    <a href="{{ route('Agence.Bus.Editer', $bus->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-danger" onclick="confirmDelete()" >
                                        <i class="fas fa-trash"></i>
                                    </a>

                                    <form id="delete-form-{{ $bus->id }}" action="{{ route('Agence.Bus.supprimer', $bus->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                            </td>
                         </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
<script>
    function confirmDelete() {
        swal({
            title: "Ètes-vous sûre ?",
            text: "Une fois supprimée vous ne pourrez plus recupérer ce contrat !",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                // Soumettre le formulaire de suppression
                document.getElementById('delete-form').submit();
            } else {
                swal("Ouf!!! Contrat sauvé de justesse !");
            }
        });
    }
</script>


@endsection