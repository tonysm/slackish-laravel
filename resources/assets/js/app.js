import './bootstrap';
import Vue from 'vue';
import ChatApp from './components/ChatApp.vue';

if (document.getElementById('app')) {
    const chatapp = new Vue({
        el: '#app',
        render: (h) => h(ChatApp),
    });
}
