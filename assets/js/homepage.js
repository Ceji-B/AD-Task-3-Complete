// Homepage JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Create floating particles
    createParticles();
    
    // Add smooth scroll and button interactions
    initializeButtonAnimations();
    
    // Add typing effect to welcome message
    initializeTypingEffect();
});

function createParticles() {
    const particlesContainer = document.createElement('div');
    particlesContainer.className = 'particles';
    document.body.appendChild(particlesContainer);
    
    for (let i = 0; i < 15; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random size and position
        const size = Math.random() * 8 + 4;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        
        // Random animation delay
        particle.style.animationDelay = Math.random() * 6 + 's';
        particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
        
        particlesContainer.appendChild(particle);
    }
}

function initializeButtonAnimations() {
    const buttons = document.querySelectorAll('button');
    
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
        
        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(0) scale(0.98)';
        });
        
        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });
    });
}

function initializeTypingEffect() {
    const welcomeText = document.querySelector('h1');
    if (welcomeText && welcomeText.textContent.includes('Welcome')) {
        const originalText = welcomeText.textContent;
        welcomeText.textContent = '';
        
        let index = 0;
        const typingSpeed = 100;
        
        function typeText() {
            if (index < originalText.length) {
                welcomeText.textContent += originalText.charAt(index);
                index++;
                setTimeout(typeText, typingSpeed);
            }
        }
        
        setTimeout(typeText, 500);
    }
}

// Add smooth page transitions
function addPageTransitions() {
    const links = document.querySelectorAll('a, form');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.tagName === 'FORM') return;
            
            e.preventDefault();
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.3s ease-out';
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 300);
        });
    });
}

// Initialize page transitions after load
window.addEventListener('load', addPageTransitions);
