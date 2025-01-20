/*
 * Mojar CMS 1.0 - Main Dashboard Layout
 *
 */

document.addEventListener('DOMContentLoaded', function() {
    // Enhanced Theme Switcher
    const themeSwitcher = {
        init() {
            this.themeButtons = document.querySelectorAll('[data-bs-theme-value]');
            this.defaultTheme = 'light';
            this.currentTheme = localStorage.getItem('theme') || this.defaultTheme;
            
            // Set initial theme
            this.setTheme(this.currentTheme);
            this.bindEvents();
            
            // Watch system theme changes
            this.watchSystemTheme();
        },

        setTheme(theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('theme', theme);
            
            this.themeButtons.forEach(button => {
                button.classList.toggle('active', button.getAttribute('data-bs-theme-value') === theme);
            });
            
            // Animate theme change
            document.body.style.transition = 'background-color 0.3s ease';
        },

        watchSystemTheme() {
            if (window.matchMedia) {
                const mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
                mediaQuery.addEventListener('change', e => {
                    if (!localStorage.getItem('theme')) {
                        this.setTheme(e.matches ? 'dark' : 'light');
                    }
                });
            }
        },

        bindEvents() {
            this.themeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const theme = button.getAttribute('data-bs-theme-value');
                    this.setTheme(theme);
                    
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.classList.add('ripple');
                    button.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 1000);
                });
            });
        }
    };

    // Enhanced Sidebar
    const sidebarManager = {
        init() {
            this.sidebar = document.querySelector('.mojar-sidebar');
            this.toggle = document.querySelector('.navbar-toggler');
            this.overlay = document.createElement('div');
            this.overlay.classList.add('sidebar-overlay');
            
            this.bindEvents();
            this.setupResizeHandler();
        },

        bindEvents() {
            if (this.toggle && this.sidebar) {
                this.toggle.addEventListener('click', () => this.toggleSidebar());
            }

            // Close sidebar when clicking overlay
            this.overlay.addEventListener('click', () => this.closeSidebar());
            
            // Handle escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') this.closeSidebar();
            });
        },

        toggleSidebar() {
            this.sidebar.classList.toggle('show');
            document.body.classList.toggle('sidebar-open');
            
            if (this.sidebar.classList.contains('show')) {
                document.body.appendChild(this.overlay);
                setTimeout(() => this.overlay.classList.add('show'), 50);
            } else {
                this.closeSidebar();
            }
        },

        closeSidebar() {
            this.sidebar.classList.remove('show');
            document.body.classList.remove('sidebar-open');
            this.overlay.classList.remove('show');
            setTimeout(() => this.overlay.remove(), 300);
        },

        setupResizeHandler() {
            let timeout;
            window.addEventListener('resize', () => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    if (window.innerWidth >= 992) {
                        this.closeSidebar();
                    }
                }, 250);
            });
        }
    };

    // Enhanced Dropdowns
    const dropdownManager = {
        init() {
            this.dropdowns = document.querySelectorAll('.dropdown');
            this.bindEvents();
        },

        bindEvents() {
            this.dropdowns.forEach(dropdown => {
                const toggle = dropdown.querySelector('.dropdown-toggle');
                const menu = dropdown.querySelector('.dropdown-menu');
                
                if (toggle && menu) {
                    toggle.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        this.toggleDropdown(dropdown);
                    });
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown')) {
                    this.closeAllDropdowns();
                }
            });
        },

        toggleDropdown(dropdown) {
            const isOpen = dropdown.classList.contains('show');
            
            // Close other dropdowns
            this.closeAllDropdowns();
            
            if (!isOpen) {
                dropdown.classList.add('show');
                dropdown.querySelector('.dropdown-menu').classList.add('show');
            }
        },

        closeAllDropdowns() {
            this.dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
                const menu = dropdown.querySelector('.dropdown-menu');
                if (menu) menu.classList.remove('show');
            });
        }
    };

    // Initialize all managers
    themeSwitcher.init();
    sidebarManager.init();
    dropdownManager.init();
    
    // Add smooth scrolling to the sidebar
    const sidebarContent = document.querySelector('.mojar-sidebar');
    if (sidebarContent) {
        new PerfectScrollbar(sidebarContent, {
            wheelSpeed: 2,
            wheelPropagation: false,
            minScrollbarLength: 20
        });
    }
}); 
