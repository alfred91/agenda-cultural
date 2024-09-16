import './bootstrap';
import Alpine from 'alpinejs';
import axios from 'axios';

window.Alpine = Alpine;
window.axios = axios;

Alpine.start();

// Manejo de navegación dinámica
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('a[data-ajax]').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            axios.get(this.href)
                .then(response => {
                    document.querySelector('#content').innerHTML = response.data;
                    window.history.pushState({}, '', this.href);
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        });
    });
});

// Manejo de cambios en el historial del navegador
window.addEventListener('popstate', () => {
    axios.get(window.location.href)
        .then(response => {
            document.querySelector('#content').innerHTML = response.data;
        })
        .catch(error => {
            console.error('Error loading content:', error);
        });
});
