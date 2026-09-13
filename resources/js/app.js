import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

// Sidebar functionality
document.addEventListener('DOMContentLoaded', function() {
    // Auto-expand menu based on current route
    const currentPath = window.location.pathname;
    
    // Check if we're in admin panel
    if (currentPath.includes('/admin/')) {
        // Auto-expand the appropriate menu section
        const menuSections = ['guru-staf', 'berita', 'agenda', 'galeri', 'downloads', 'buku-tamu', 'users', 'roles'];
        
        menuSections.forEach(section => {
            if (currentPath.includes(section)) {
                // Set active menu in Alpine.js data
                if (window.Alpine) {
                    const alpineComponent = document.querySelector('[x-data]').__x.$data;
                    if (alpineComponent && alpineComponent.activeMenu !== section) {
                        alpineComponent.activeMenu = section;
                    }
                }
            }
        });
    }
    
    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('[x-data]');
        const sidebarToggle = document.querySelector('[x-data] button');
        
        if (sidebar && sidebarToggle && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            if (window.Alpine) {
                const alpineComponent = sidebar.__x.$data;
                if (alpineComponent && alpineComponent.sidebarOpen) {
                    alpineComponent.sidebarOpen = false;
                }
            }
        }
    });
    
    // Keyboard navigation support
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const sidebar = document.querySelector('[x-data]');
            if (sidebar && window.Alpine) {
                const alpineComponent = sidebar.__x.$data;
                if (alpineComponent && alpineComponent.sidebarOpen) {
                    alpineComponent.sidebarOpen = false;
                }
            }
        }
        
        // Toggle sidebar with Ctrl + B
        if (event.ctrlKey && event.key === 'b') {
            event.preventDefault();
            const sidebar = document.querySelector('[x-data]');
            if (sidebar && window.Alpine) {
                const alpineComponent = sidebar.__x.$data;
                if (alpineComponent) {
                    alpineComponent.toggleSidebar();
                }
            }
        }
    });
    
    // Save sidebar state to localStorage
    function saveSidebarState(collapsed) {
        try {
            localStorage.setItem('sidebarCollapsed', JSON.stringify(collapsed));
        } catch (e) {
            console.warn('Could not save sidebar state to localStorage:', e);
        }
    }
    
    // Load sidebar state from localStorage
    function loadSidebarState() {
        try {
            const saved = localStorage.getItem('sidebarCollapsed');
            if (saved !== null) {
                return JSON.parse(saved);
            }
        } catch (e) {
            console.warn('Could not load sidebar state from localStorage:', e);
        }
        return false; // Default to expanded
    }
    
    // Apply saved sidebar state
    const savedState = loadSidebarState();
    if (savedState !== null) {
        setTimeout(() => {
            const sidebar = document.querySelector('[x-data]');
            if (sidebar && window.Alpine) {
                const alpineComponent = sidebar.__x.$data;
                if (alpineComponent) {
                    alpineComponent.sidebarCollapsed = savedState;
                }
            }
        }, 100);
    }
    
    // Listen for sidebar state changes
    document.addEventListener('alpine:init', () => {
        Alpine.data('sidebarState', () => ({
            collapsed: false,
            init() {
                this.$watch('collapsed', (value) => {
                    saveSidebarState(value);
                });
            }
        }));
    });
    
    // Responsive sidebar behavior
    function handleResize() {
        const sidebar = document.querySelector('[x-data]');
        if (sidebar && window.Alpine) {
            const alpineComponent = sidebar.__x.$data;
            if (alpineComponent) {
                // Auto-collapse on small screens
                if (window.innerWidth < 1024) {
                    alpineComponent.sidebarCollapsed = true;
                }
            }
        }
    }
    
    // Debounced resize handler
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(handleResize, 250);
    });
    
    // Initial resize check
    handleResize();
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    document.addEventListener('touchstart', function(event) {
        touchStartX = event.changedTouches[0].screenX;
    });
    
    document.addEventListener('touchend', function(event) {
        touchEndX = event.changedTouches[0].screenX;
        handleSwipe();
    });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            const sidebar = document.querySelector('[x-data]');
            if (sidebar && window.Alpine) {
                const alpineComponent = sidebar.__x.$data;
                if (alpineComponent) {
                    if (diff > 0) {
                        // Swipe left - open sidebar
                        if (window.innerWidth < 1024) {
                            alpineComponent.sidebarOpen = true;
                        }
                    } else {
                        // Swipe right - close sidebar
                        if (window.innerWidth < 1024) {
                            alpineComponent.sidebarOpen = false;
                        }
                    }
                }
            }
        }
    }
});

// Smooth scrolling for sidebar
function smoothScrollTo(element, duration = 300) {
    const targetPosition = element.getBoundingClientRect().top;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }

    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

// Sidebar utility functions
function toggleSidebar() {
    const sidebar = document.querySelector('[x-data]');
    if (sidebar && window.Alpine) {
        const alpineComponent = sidebar.__x.$data;
        if (alpineComponent) {
            alpineComponent.toggleSidebar();
        }
    }
}

function expandSidebar() {
    const sidebar = document.querySelector('[x-data]');
    if (sidebar && window.Alpine) {
        const alpineComponent = sidebar.__x.$data;
        if (alpineComponent) {
            alpineComponent.sidebarCollapsed = false;
        }
    }
}

function collapseSidebar() {
    const sidebar = document.querySelector('[x-data]');
    if (sidebar && window.Alpine) {
        const alpineComponent = sidebar.__x.$data;
        if (alpineComponent) {
            alpineComponent.sidebarCollapsed = true;
        }
    }
}

// Export functions for global use
window.sidebarUtils = {
    smoothScrollTo,
    toggleSidebar,
    expandSidebar,
    collapseSidebar
};

// Add global keyboard shortcuts
document.addEventListener('keydown', function(event) {
    // Ctrl + B to toggle sidebar
    if (event.ctrlKey && event.key === 'b') {
        event.preventDefault();
        toggleSidebar();
    }
    
    // Ctrl + Shift + B to expand sidebar
    if (event.ctrlKey && event.shiftKey && event.key === 'B') {
        event.preventDefault();
        expandSidebar();
    }
    
    // Ctrl + Alt + B to collapse sidebar
    if (event.ctrlKey && event.altKey && event.key === 'b') {
        event.preventDefault();
        collapseSidebar();
    }
});
