window.Vue = require('vue');

//window.axios = require('axios');

import AppLayout from './components/appLayout.vue'
import router from './router/routes'
import axios from 'axios'
import VueSwal from 'vue-swal';

window.axios = axios.create()

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('vue-spinner', require('vue-simple-spinner'));

Vue.use(VueSwal)


const app = new Vue({
    el: '#app',
    components: {
        AppLayout,
    },
    router
    
});