window.reservationSystem = function () {
    return {
        isLoading: false,
        errorMessage: '',
        sieges: [],
        selectedSiege: null,
        selectedVoyage: null,
        total: 0,

        init() {
            console.log('Composant Alpine initialisé');
        },

        fetchSieges() {
            this.isLoading = true;
            this.errorMessage = '';
            this.sieges = [];
            this.selectedSiege = null;
            this.total = 0;

            fetch(`/api/voyages/${this.selectedVoyage}/sieges`)
                .then(res => res.ok ? res.json() : Promise.reject(res))
                .then(data => {
                    this.sieges = data;
                })
                .catch(err => {
                    this.errorMessage = 'Impossible de charger les sièges.';
                    console.error(err);
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },

        selectSiege(numero, prix) {
            this.selectedSiege = numero;
            this.total = prix;
        }
    }
}
