// Reservation management JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize seat map
    initializeSeatMap();

    // Handle reservation form
    const reservationForm = document.getElementById('reservationForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm(reservationForm)) {
                return;
            }

            const selectedSeats = document.querySelectorAll('.seat.selected');
            if (selectedSeats.length === 0) {
                showError('Veuillez sélectionner au moins un siège');
                return;
            }

            const reservationData = {
                passengerName: document.getElementById('passengerName').value,
                passengerEmail: document.getElementById('passengerEmail').value,
                passengerPhone: document.getElementById('passengerPhone').value,
                selectedSeats: Array.from(selectedSeats).map(seat => seat.dataset.seatNumber),
                tripId: getTripIdFromUrl(), // You would typically get this from the URL
                totalPrice: calculateTotalPrice()
            };

            // Here you would typically make an API call to save the reservation
            console.log('Reservation data:', reservationData);
            showSuccess('Réservation effectuée avec succès');
            
            // Redirect to confirmation page after successful reservation
            setTimeout(() => {
                window.location.href = 'confirmation.html';
            }, 2000);
        });
    }
});

// Initialize seat map
function initializeSeatMap() {
    const seatMap = document.getElementById('seatMap');
    if (!seatMap) return;

    const rows = 5;
    const seatsPerRow = 6;
    const seatLayout = document.createElement('div');
    seatLayout.className = 'row g-2 justify-content-center';

    for (let i = 0; i < rows; i++) {
        for (let j = 0; j < seatsPerRow; j++) {
            const seatNumber = i * seatsPerRow + j + 1;
            const seat = document.createElement('div');
            seat.className = 'seat available';
            seat.dataset.seatNumber = seatNumber;
            seat.textContent = seatNumber;

            // Randomly mark some seats as occupied
            if (Math.random() < 0.3) {
                seat.className = 'seat occupied';
            } else {
                seat.addEventListener('click', toggleSeatSelection);
            }

            const seatCol = document.createElement('div');
            seatCol.className = 'col-2';
            seatCol.appendChild(seat);
            seatLayout.appendChild(seatCol);
        }
    }

    seatMap.appendChild(seatLayout);
    updateTotalPrice();
}

// Toggle seat selection
function toggleSeatSelection(e) {
    const seat = e.target;
    if (seat.classList.contains('occupied')) return;

    seat.classList.toggle('selected');
    updateTotalPrice();
}

// Calculate total price
function calculateTotalPrice() {
    const basePrice = 150; // You would typically get this from the trip data
    const serviceFee = 10;
    const selectedSeats = document.querySelectorAll('.seat.selected').length;
    return (basePrice + serviceFee) * selectedSeats;
}

// Update total price display
function updateTotalPrice() {
    const totalPrice = calculateTotalPrice();
    const priceElement = document.querySelector('.summary-details strong:last-child');
    if (priceElement) {
        priceElement.textContent = `${totalPrice} €`;
    }
}

// Form validation helper
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required]');
    
    inputs.forEach(input => {
        if (!input.value) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');

            // Email validation
            if (input.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }

            // Phone validation
            if (input.type === 'tel') {
                const phoneRegex = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/;
                if (!phoneRegex.test(input.value)) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }
        }
    });

    return isValid;
}

// Helper function to get trip ID from URL
function getTripIdFromUrl() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('tripId') || '1'; // Default to '1' if not specified
}

// Success message display
function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'alert alert-success mt-3';
    successDiv.textContent = message;
    
    const form = document.querySelector('form');
    form.parentNode.insertBefore(successDiv, form.nextSibling);

    setTimeout(() => {
        successDiv.remove();
    }, 5000);
}

// Error message display
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger mt-3';
    errorDiv.textContent = message;
    
    const form = document.querySelector('form');
    form.parentNode.insertBefore(errorDiv, form.nextSibling);

    setTimeout(() => {
        errorDiv.remove();
    }, 5000);
}