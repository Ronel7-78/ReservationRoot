@extends('../Template.app')

@section('Travel')
<title>Liste des Trajets</title>
<div class="row g-3 my-5">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-route me-2"></i>Liste des Trajets  </h4>
            </div>
            <div class="card-body">
                <table id="trajetsTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Trajet</th>
                            <th>Standing</th>
                            <th>Prix</th>
                            
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if($trajets->isEmpty())
                        <div class="alert alert-info">Aucun trajet enregistré pour le moment</div>
                    @else
                        @foreach($trajets as $trajet)
                        <tr>
                            <td>{{ $trajet->ville_depart }} → {{ $trajet->ville_arrivee }}</td>
                            <td>{{ $trajet->standing }}</td>
                            <td>{{ number_format($trajet->prix, 0, ',', ' ') }} FCFA</td>

                            <td>

                                <a href="" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('Agence.Trajet.supprimer',$trajet->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                        </td>
                        </tr>

                        @endforeach
                        @endif
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
    $('#trajetsTable').DataTable({
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