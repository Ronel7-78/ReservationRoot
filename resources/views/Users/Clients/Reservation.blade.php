@extends('../Template.app')

@section('Travel')
<div class="row">
        <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="container" x-data="{ selectedSeat: null }">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Réservation - {{ $client->name }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        
                        <!-- Sélection du voyage -->
                        <div class="mb-4">
                            <label class="form-label">Voyage</label>
                            <select name="voyage_id" class="form-select" required @change="fetchSeats($event.target.value)">
                                @foreach($voyages as $voyage)
                                    <option value="{{ $voyage->id }}">
                                        {{ $voyage->trajet->ville_depart }} → {{ $voyage->trajet->ville_arrivee }}
                                        ({{ $voyage->date_depart->isoFormat('LL HH:mm') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Carte des sièges -->
                        <div class="mb-4" id="seats-container">
                            <label class="form-label">Choix du siège</label>
                            <div class="row g-2" id="seats">
                                <!-- Les sièges seront ajoutés ici dynamiquement via JavaScript -->
                            </div>
                            <input type="hidden" name="numero_siege" x-model="selectedSeat">
                        </div>



                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>   
    </div>
    <div class="col-md-2"></div>
</div>


@endsection

@section('scripts')
    <script>
        // Exemple de fonction pour récupérer les sièges selon le voyage sélectionné
        function fetchSeats(voyageId) {
            // Utilisez AJAX ou Fetch API pour obtenir les sièges pour le voyage sélectionné
            fetch(`/api/voyages/${voyageId}/sieges`)
                .then(response => response.json())
                .then(data => {
                    const seatsContainer = document.getElementById('seats');
                    seatsContainer.innerHTML = ''; // Réinitialiser le conteneur

                    data.sieges.forEach(siege => {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.className = `btn w-100 ${siege.disponible ? 'btn-outline-primary' : 'btn-danger disabled'}`;
                        button.innerText = siege.numero;
                        button.disabled = !siege.disponible;
                        button.onclick = () => {
                            if (siege.disponible) {
                                selectedSeat = siege.numero; // Mettez à jour votre variable
                            }
                        };

                        const col = document.createElement('div');
                        col.className = 'col-2';
                        col.appendChild(button);
                        seatsContainer.appendChild(col);
                    });
                });
        }
    </script>
@endsection