// Authentication related JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Login form handling
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;

            // Validate form
            if (!validateForm(loginForm)) {
                return;
            }

            // Here you would typically make an API call to authenticate
            const loginData = {
                email,
                password,
                rememberMe
            };

            // Simulate API call
            console.log('Login attempt:', loginData);
            // Redirect to dashboard or home page after successful login
            window.location.href = 'index.html';
        });
    }

    // Registration form handling
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                password: document.getElementById('password').value,
                confirmPassword: document.getElementById('confirmPassword').value,
                role: document.getElementById('role').value,
                terms: document.getElementById('terms').checked
            };

            // Validate form
            if (!validateForm(registerForm)) {
                return;
            }

            // Additional validation for password match
            if (formData.password !== formData.confirmPassword) {
                showError('Les mots de passe ne correspondent pas');
                return;
            }

            // Here you would typically make an API call to register the user
            console.log('Registration data:', formData);
            // Redirect to login page after successful registration
            window.location.href = 'login.html';
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

        // Email validation
        if (input.type === 'email' && input.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(input.value)) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        }

        // Phone validation
        if (input.type === 'tel' && input.value) {
            const phoneRegex = /^[+]?[(]?[0-9]{3}[)]?[-\s.]?[0-9]{3}[-\s.]?[0-9]{4,6}$/;
            if (!phoneRegex.test(input.value)) {
                input.classList.add('is-invalid');
                isValid = false;
            }
        }
    });

    return isValid;
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

// Password strength checker
function checkPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[!@#$%^&*]+/)) strength++;
    return strength;
}

// Add password strength indicator
const passwordInput = document.getElementById('password');
if (passwordInput) {
    passwordInput.addEventListener('input', function(e) {
        const strength = checkPasswordStrength(e.target.value);
        const strengthBar = document.querySelector('.password-strength');
        if (!strengthBar) {
            const bar = document.createElement('div');
            bar.className = 'password-strength progress mt-2';
            bar.innerHTML = '<div class="progress-bar" role="progressbar"></div>';
            this.parentNode.appendChild(bar);
        }
        
        const progressBar = document.querySelector('.progress-bar');
        progressBar.style.width = `${strength * 20}%`;
        progressBar.className = `progress-bar ${strength < 3 ? 'bg-danger' : strength < 4 ? 'bg-warning' : 'bg-success'}`;
    });
}