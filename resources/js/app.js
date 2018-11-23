import './bootstrap';
import Vue from 'vue';
import Vuex from 'vuex';
import App from './App.vue';
import store from './store';
import { LOAD_USER } from './store/mutations';

Vue.use(Vuex);

if (document.getElementById('app')) {
    const chatapp = new Vue({
        el: '#app',
        store: new Vuex.Store(store),
        render: (h) => h(App),
        created() {
            this.$store.commit({
                type: LOAD_USER,
                user: window.Laravel.user,
                company: window.Laravel.company,
            });
        }
    });
}
