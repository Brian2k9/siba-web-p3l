window.Vue = require('vue');

//window.axios = require('axios');

import AppLayout from './components/appLayout.vue'
import router from './router/routes'
import axios from 'axios'

window.axios = axios.create()




const app = new Vue({
    el: '#app',
    components: {
        AppLayout,
    },
    router
    
});