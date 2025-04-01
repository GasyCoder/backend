import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Définir un store global pour la sidebar
document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        open: window.innerWidth >= 1024,
        toggle() {
            this.open = !this.open;
        }
    });
});

// Configuration
document.addEventListener('DOMContentLoaded', () => {
    // Code pour le dark mode (conservez votre code existant)
    Alpine.data('darkModeConfig', () => ({
        // Votre configuration existante pour le dark mode
    }));

    // Configuration mise à jour pour la sidebar
    Alpine.data('sidebarConfig', () => ({
        sidebarOpen: window.innerWidth >= 1024,

        init() {
            // Synchroniser avec le store global
            this.sidebarOpen = Alpine.store('sidebar').open;

            // Observer les changements dans le store global
            this.$watch('$store.sidebar.open', (value) => {
                this.sidebarOpen = value;
            });

            // Ajuster la sidebar en fonction de la taille de l'écran
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 1024) {
                    this.sidebarOpen = true;
                    Alpine.store('sidebar').open = true;
                }
            });
        }
    }));

    Alpine.start();
});

// Fonction pour basculer la sidebar depuis un bouton standard (non-Alpine)
function toggleSidebar() {
    if (Alpine.store('sidebar')) {
        Alpine.store('sidebar').toggle();
    }
}

// Rendre la fonction disponible globalement
window.toggleSidebar = toggleSidebar;
