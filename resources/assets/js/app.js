import './bootstrap';
import Vue from 'vue';
import Vuex from 'vuex';
import App from './App.vue';
import store from './store';

Vue.use(Vuex);

if (document.getElementById('app')) {
    const chatapp = new Vue({
        el: '#app',
        store: new Vuex.Store(store),
        render: (h) => h(App),
    });
}
