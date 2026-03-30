import axios from 'axios';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Initialize Pusher directly
var pusher = new Pusher(window.VITE_PUSHER_APP_KEY || '121c9a2f16d51812faca', {
    cluster: window.VITE_PUSHER_APP_CLUSTER || 'eu',
    forceTLS: true,
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
    },
});

pusher.connection.bind('connected', function() {
    console.log('%c✅ Pusher Connected directly!', 'color: green; font-weight: bold; font-size: 14px');
});

pusher.connection.bind('disconnected', function() {
    console.log('%c❌ Pusher Disconnected', 'color: red; font-weight: bold; font-size: 14px');
});

pusher.connection.bind('error', function(err) {
    console.log('%c❌ Pusher Error:', 'color: red; font-weight: bold', err);
});

// Make pusher globally available
window.pusher = pusher;

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
