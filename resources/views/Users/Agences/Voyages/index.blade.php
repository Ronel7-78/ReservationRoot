@extends('../Template.app')

@section('Travel')
<title>Liste des Voyages</title>
<div class="row g-3  my-5 ">
    <div class="col-md-1"></div>
    <div class="col-md-10">
                <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-route me-2"></i>Liste des voyages</h4>
            </div>
            <div class="card-body bd">
                <table id="voyagesTable" class="table table-striped " style="width:100%">
                    <thead>
                        <tr>
                            <th>Trajet</th>
                            <th>Date départ</th>
                            <th>Bus</th>
                            <th>Places restantes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($voyages as $voyage)
                        <tr>
                            <td>{{ $voyage->trajet->ville_depart }} → {{ $voyage->trajet->ville_arrivee }}</td>
                            <td>{{ $voyage->date_depart->format('d/m/Y H:i') }}</td>
                            <td>{{ $voyage->bus->immatriculation }}</td>
                            <td>{{ $voyage->bus->nombre_place - $voyage->reservations->count() }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
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

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#voyagesTable').DataTable({
        responsive: true,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        columnDefs: [
            { orderable: false, targets: 4 }
        ]
    });
});
</script>
@endsection