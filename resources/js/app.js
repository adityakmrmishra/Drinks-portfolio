import './bootstrap';

// Import Bootstrap JS with Popper.js
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

// Theme switching utilities
document.addEventListener('DOMContentLoaded', function() {
    // Watch for system theme changes if user has selected 'system' theme
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    
    prefersDarkScheme.addEventListener('change', function(e) {
        // Only update if the user has chosen 'system' theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'system') {
            document.documentElement.setAttribute('data-bs-theme', 
                e.matches ? 'dark' : 'light');
        }
    });
});

// Function to apply theme (can be called when user changes theme in settings)
window.applyTheme = function(theme) {
    if (theme === 'system') {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        document.documentElement.setAttribute('data-bs-theme', 
            prefersDark ? 'dark' : 'light');
    } else {
        document.documentElement.setAttribute('data-bs-theme', theme);
    }
    localStorage.setItem('theme', theme);
};

// Any additional custom JavaScript can go here
