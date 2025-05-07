@extends('../Template.app')

@section('Travel')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        {{-- Container Alpine --}}
        <div class="container"
             x-data="reservationSystem()"
             x-cloak
             :class="{ 'opacity-50 pointer-events-none': isLoading }">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5>Réservation – {{ $client->name }}</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('reservations.store') }}" method="POST" @submit.prevent="submitForm">
                        @csrf

                        <!-- Sélection du voyage -->
                        <div class="mb-4">
                            <label class="form-label">Voyage</label>
                            <select name="voyage_id"
                                    class="form-select"
                                    required
                                    x-model="selectedVoyage"
                                    @change="fetchSieges($event.target.value)"
                                    x-cloak>
                                <option value="">Sélectionnez un voyage</option>
                                @foreach($voyages as $voyage)
                                    <option value="{{ $voyage->id }}"
                                            data-prix="{{ $voyage->tarif }}"
                                            data-bus="{{ $voyage->bus->nombre_place }}">
                                        [{{ optional($voyage->bus->agence)->nom_commercial ?? 'Agence inconnue' }}]
                                        {{ $voyage->trajet->ville_depart }} → {{ $voyage->trajet->ville_arrivee }}
                                        ({{ $voyage->date_depart }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Indicateur de chargement -->
                        <div class="text-center my-3"
                             x-show="isLoading"
                             x-cloak>
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Chargement...</span>
                            </div>
                        </div>

                        <!-- Message d'erreur -->
                        <div class="alert alert-danger"
                             x-show="errorMessage"
                             x-text="errorMessage"
                             x-cloak>
                        </div>

                        <!-- Grille des sièges -->
                        <div class="seat-map"
                             x-show="!isLoading && sieges.length > 0"
                             x-cloak>
                            <template x-for="siege in sieges" :key="siege.numero">
                                <div
                                    class="seat"
                                    :class="{
                                        'occupied': !siege.disponible,
                                        'available': siege.disponible && selectedSiege !== siege.numero,
                                        'selected': selectedSiege === siege.numero
                                    }"
                                    @click="selectSiege(siege)"
                                    x-text="siege.numero"
                                ></div>
                            </template>
                        </div>

                        <!-- Message si aucun siège dispo -->
                        <p class="text-danger text-center mt-3"
                           x-show="!isLoading && sieges.length === 0"
                           x-cloak>
                            Aucun siège disponible pour ce voyage.
                        </p>

                        <!-- Résumé -->
                        <div class="resume-card card mt-4"
                             x-show="selectedSieges.length"
                             x-cloak>
                            <div class="card-body">
                                <h5 class="card-title">Résumé</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Siège sélectionné :</span>
                                    <span x-text="selectedSieges.join(', ')"></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total :</span>
                                    <span x-text="`${total} FCFA`"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Champs cachés pour l’envoi -->
                        <input type="hidden" name="siege_numero" :value="selectedSiege">
                        <template x-for="numero in selectedSieges" :key="numero">
                            <input type="hidden" name="siege_numeros[]" :value="numero">
                        </template>

                        <!-- Bouton de validation -->
                        <div class="mt-3 text-center" x-show="selectedSieges.length" x-cloak>
                            <button class="btn btn-success" type="submit">Valider la réservation</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
@endsection

@push('styles')
<style>
/* Masquer avant qu’Alpine ne prenne la main */
[x-cloak] { display: none !important; }

/* Grille des sièges */
.seat-map {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    padding: 20px;
    background: #f1f3f5;
    border-radius: 10px;
    margin-top: 20px;
}
.seat {
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
    cursor: pointer;
}
.seat.available {
    background-color: #28a745;
    color: white;
    border: 2px solid #28a745;
}
.seat.available:hover {
    background-color: #218838;
    transform: scale(1.05);
}
.seat.selected {
    background-color: #007bff;
    color: white;
    border: 2px solid #0056b3;
}
.seat.occupied {
    background-color: #dc3545;
    color: white;
    border: 2px solid #c82333;
    cursor: not-allowed;
}

/* Opacité pendant chargement */
.opacity-50 { opacity: .5; }
.pointer-events-none { pointer-events: none; }
</style>
@endpush


