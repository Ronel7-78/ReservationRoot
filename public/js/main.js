// Main JavaScript file for the home page

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap components
    var carouselElement = document.querySelector('#destinationCarousel')
    if (carouselElement) {
        new bootstrap.Carousel(carouselElement, {
            interval: 5000,
            wrap: true
        });
    }

    // Search form handling
    const searchForm = document.querySelector('.search-section form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const searchData = {
                departure: formData.get('departure'),
                destination: formData.get('destination'),
                date: formData.get('date'),
                passengers: formData.get('passengers')
            };

            // Here you would typically make an API call to search for flights
            console.log('Search data:', searchData);
            // Redirect to search results page
            window.location.href = `voyages.html?departure=${searchData.departure}&destination=${searchData.destination}&date=${searchData.date}&passengers=${searchData.passengers}`;
        });
    }

    // Add smooth scrolling for all links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add animation classes to elements when they come into view
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.card, .testimonial-card');
        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('fade-in');
            }
        });
    };

    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Initial check for elements in view
});

// Handle search form validation
function validateSearchForm(form) {
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

// Handle responsive navigation
const navbarToggler = document.querySelector('.navbar-toggler');
if (navbarToggler) {
    navbarToggler.addEventListener('click', function() {
        const navbarCollapse = document.querySelector('.navbar-collapse');
        if (navbarCollapse.classList.contains('show')) {
            navbarCollapse.classList.remove('show');
        } else {
            navbarCollapse.classList.add('show');
        }
    });
}

// Handle search suggestions (you would typically connect this to an API)
const searchInput = document.querySelector('input[type="search"]');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const value = e.target.value;
        if (value.length >= 2) {
            // Here you would typically make an API call to get suggestions
            console.log('Searching for:', value);
        }
    });
}