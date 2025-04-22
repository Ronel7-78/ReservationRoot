@extends('../Template.app')

@section('Travel')
<title>Ajouter un Voyage </title>
<div class="container my-5">
    <div class="row g-3">
        <div class="col-md-3"></div>
        <div class="col-md-6 ">
           <div class="card shadow bd">
                <div class="card-header bg-primary text-white">
                    <h4>Ajouter un Trajet</h4>
                </div>
                <div class="card-body">
                    <form id="voyageForm" action="{{ route('Agence.Voyage.store') }}" method="POST">
                        @csrf
                    
                        <div class="mb-3">
                            <label>Trajet*</label>
                            <select name="trajet_id" class="form-select" >
                                @foreach($trajets as $trajet)
                                    <option value="{{ $trajet->id }}">
                                        {{ $trajet->ville_depart }} → {{ $trajet->ville_arrivee }}
                                        ({{ $trajet->standing }} - {{ $trajet->prix }} FCFA)
                                    </option>
                                @endforeach
                            </select>
                            @error('trajet_id')
                                <div class="text text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        
                                <div class="mb-3">
                                    <label>Bus*</label>
                                    <select name="bus_id" class="form-select" id="busSelect">
                                        @foreach($buses as $bus)
                                            <option value="{{ $bus->id }}" 
                                                data-photo="{{ asset('storage/'.$bus->photo_exterieur) }}"
                                                data-available="true">
                                                {{ $bus->libelle }} ({{ $bus->immatriculation }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('bus_id')
                                        <div class="text text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Date de départ*</label>
                                    <input type="datetime-local" name="date_depart" 
                                        class="form-control" min="{{ now()->format('Y-m-d\TH:i') }}" >
                                        @error('date_depart')
                                            <div class="text text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>
                            
                        </div>
                    
                        <div id="availabilityStatus" class="alert d-none"></div>
                    
                        <button type="submit" class="btn btn-primary">Planifier le voyage</button>
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


<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('dateDepart');
    const busSelect = document.getElementById('busSelect');
    const availabilityStatus = document.getElementById('availabilityStatus');

    async function checkAvailability() {
        const selectedDate = dateInput.value;
        const selectedBus = busSelect.value;

        if(!selectedDate || !selectedBus) return;

        try {
            const response = await fetch(`/check-bus-disponibilite?bus_id=${selectedBus}&date=${selectedDate}`);
            const data = await response.json();
            
            if(data.disponible) {
                availabilityStatus.classList.remove('alert-danger', 'd-none');
                availabilityStatus.classList.add('alert-success');
                availabilityStatus.textContent = 'Bus disponible pour cette date';
            } else {
                availabilityStatus.classList.remove('alert-success', 'd-none');
                availabilityStatus.classList.add('alert-danger');
                availabilityStatus.textContent = 'Bus déjà réservé pour cette date';
            }
        } catch (error) {
            console.error('Erreur de vérification:', error);
        }
    }

    dateInput.addEventListener('change', checkAvailability);
    busSelect.addEventListener('change', checkAvailability);
});
</scrip>

@endsection