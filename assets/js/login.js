// Login page JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    initializeFormValidation();
    addInputAnimations();
    initializeLoginAnimations();
});

function initializeFormValidation() {
    const form = document.querySelector('form');
    const inputs = document.querySelectorAll('.form-input');
    
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                showInputError(input, 'This field is required');
            } else {
                clearInputError(input);
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showShakeAnimation(form);
            
            // Reset submit button if validation fails
            const submitBtn = this.querySelector('.login-submit');
            if (submitBtn) {
                submitBtn.innerHTML = 'Login';
                submitBtn.disabled = false;
            }
        }
        // If valid, let the form submit normally (don't prevent default)
    });
}

function addInputAnimations() {
    const inputs = document.querySelectorAll('.form-input');
    
    inputs.forEach(input => {
        // Add focus animations
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
            createRippleEffect(this);
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
        
        // Add real-time validation
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                clearInputError(this);
                this.style.borderColor = '#27ae60';
            } else {
                this.style.borderColor = '#e0e6ed';
            }
        });
    });
}

function showInputError(input, message) {
    clearInputError(input);
    
    input.style.borderColor = '#e74c3c';
    input.style.boxShadow = '0 0 0 3px rgba(231, 76, 60, 0.1)';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'input-error';
    errorDiv.textContent = message;
    errorDiv.style.color = '#e74c3c';
    errorDiv.style.fontSize = '0.85rem';
    errorDiv.style.marginTop = '0.5rem';
    errorDiv.style.animation = 'fadeInUp 0.3s ease-out';
    
    input.parentElement.appendChild(errorDiv);
}

function clearInputError(input) {
    const existingError = input.parentElement.querySelector('.input-error');
    if (existingError) {
        existingError.remove();
    }
    input.style.borderColor = '#e0e6ed';
    input.style.boxShadow = 'none';
}

function createRippleEffect(element) {
    const ripple = document.createElement('div');
    ripple.style.position = 'absolute';
    ripple.style.borderRadius = '50%';
    ripple.style.background = 'rgba(52, 152, 219, 0.3)';
    ripple.style.width = '20px';
    ripple.style.height = '20px';
    ripple.style.left = '10px';
    ripple.style.top = '50%';
    ripple.style.transform = 'translateY(-50%) scale(0)';
    ripple.style.animation = 'ripple 0.6s linear';
    ripple.style.pointerEvents = 'none';
    
    element.parentElement.style.position = 'relative';
    element.parentElement.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

function showShakeAnimation(element) {
    element.style.animation = 'shake 0.5s ease-in-out';
    setTimeout(() => {
        element.style.animation = '';
    }, 500);
}

function initializeLoginAnimations() {
    // Simplified - no button animation to avoid interference
    // Just add entrance animation to login card
    const loginCard = document.querySelector('.login-card');
    if (loginCard) {
        loginCard.style.opacity = '0';
        loginCard.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            loginCard.style.transition = 'all 0.6s ease-out';
            loginCard.style.opacity = '1';
            loginCard.style.transform = 'translateY(0)';
        }, 100);
    }
}

// Add CSS for loading spinner and ripple effect
const additionalCSS = `
    @keyframes ripple {
        to {
            transform: translateY(-50%) scale(4);
            opacity: 0;
        }
    }
    
    .loading-spinner {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    .form-group.focused .form-input {
        transform: scale(1.02);
    }
`;

// Inject additional CSS
const styleSheet = document.createElement('style');
styleSheet.textContent = additionalCSS;
document.head.appendChild(styleSheet);
