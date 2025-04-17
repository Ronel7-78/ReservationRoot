// Routes management JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Add route form handling
    const addRouteForm = document.getElementById('addRouteForm');
    if (addRouteForm) {
        addRouteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm(addRouteForm)) {
                return;
            }

            const routeData = {
                departure: document.getElementById('departure').value,
                destination: document.getElementById('destination').value,
                type: document.getElementById('type').value,
                price: parseFloat(document.getElementById('price').value),
                departureDate: document.getElementById('departureDate').value,
                departureTime: document.getElementById('departureTime').value,
                seats: parseInt(document.getElementById('seats').value)
            };

            // Here you would typically make an API call to save the route
            console.log('New route data:', routeData);
            showSuccess('Trajet ajouté avec succès');
            
            // Reset form after successful submission
            addRouteForm.reset();
        });
    }

    // Date validation
    const departureDateInput = document.getElementById('departureDate');
    if (departureDateInput) {
        departureDateInput.min = new Date().toISOString().split('T')[0];
        departureDateInput.addEventListener('change', function(e) {
            const selectedDate = new Date(e.target.value);
            const today = new Date();
            if (selectedDate < today) {
                e.target.value = today.toISOString().split('T')[0];
                showError('La date de départ ne peut pas être dans le passé');
            }
        });
    }

    // Price validation
    const priceInput = document.getElementById('price');
    if (priceInput) {
        priceInput.addEventListener('input', function(e) {
            const value = parseFloat(e.target.value);
            if (value < 0) {
                e.target.value = 0;
                showError('Le prix ne peut pas être négatif');
            }
        });
    }

    // Seats validation
    const seatsInput = document.getElementById('seats');
    if (seatsInput) {
        seatsInput.addEventListener('input', function(e) {
            const value = parseInt(e.target.value);
            if (value < 1) {
                e.target.value = 1;
                showError('Le nombre de sièges doit être au moins 1');
            }
        });
    }
});

// Form validation helper
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], select[required]');
    
    inputs.forEach(input => {
        if (!input.value) {
            input.classList.add('is-invalid');
            isValid = false;
        } else {
            input.classList.remove('is-invalid');
        }
    });

    return isValid;
}

// Success message display
function showSuccess(message) {
    const successDiv = document.createElement('div');
    successDiv.className = 'alert alert-success mt-3';
    successDiv.textContent = message;
    
    // Remove any existing success messages
    const existingSuccess = document.querySelector('.alert-success');
    if (existingSuccess) {
        existingSuccess.remove();
    }

    // Add the new success message
    const form = document.querySelector('form');
    form.parentNode.insertBefore(successDiv, form.nextSibling);

    // Remove the success message after 5 seconds
    setTimeout(() => {
        successDiv.remove();
    }, 5000);
}

// Error message display
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-danger mt-3';
    errorDiv.textContent = message;
    
    // Remove any existing error messages
    const existingError = document.querySelector('.alert-danger');
    if (existingError) {
        existingError.remove();
    }

    // Add the new error message
    const form = document.querySelector('form');
    form.parentNode.insertBefore(errorDiv, form.nextSibling);

    // Remove the error message after 5 seconds
    setTimeout(() => {
        errorDiv.remove();
    }, 5000);
}

// City autocomplete (you would typically connect this to an API)
const cityInputs = document.querySelectorAll('#departure, #destination');
cityInputs.forEach(input => {
    if (input) {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            if (value.length >= 2) {
                // Here you would typically make an API call to get city suggestions
                console.log('Searching for city:', value);
            }
        });
    }
});