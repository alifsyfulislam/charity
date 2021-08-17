import Vue from 'vue'
import App from './App.vue'
import router from './router'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import './assets/fontawesome/css/fontawesome.min.css'
import './assets/fontawesome/css/all.min.css'
import './assets/css/bootstarp-custom.css'
import './assets/css/custom.css'

axios.defaults.baseURL = "http://localhost/charity/public/api";
// axios.defaults.headers.common["Authorization"] = 'Bearer '+ localStorage.token;

Vue.config.productionTip = false

new Vue({
    router,
    BootstrapVue,
    IconsPlugin,
    axios,
    VueAxios,
    render: h => h(App)
}).$mount('#app')
