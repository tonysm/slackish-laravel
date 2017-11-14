import './bootstrap';
import Vue from 'vue';
import App from './App.vue';

if (document.getElementById('app')) {
    const chatapp = new Vue({
        el: '#app',
        render: (h) => h(App),
    });
}
