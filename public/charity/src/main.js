import Vue from 'vue'
import App from './App.vue'
import router from './router'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import './assets/fontawesome/css/fontawesome.min.css'
import './assets/fontawesome/css/all.min.css'
import './assets/css/A.bootstrap.min.css+font-awesome.min.css+elegant-fonts.css+themify-icons.css+swiper.min.css,Mcc.BgW-eGVxh5.css.pagespeed.cf.z1yXREZTTN.css'
import './assets/css/A.style.css.pagespeed.cf.5NtMCPMuKO.css'

Vue.config.productionTip = false

new Vue({
    router,
    BootstrapVue,
    IconsPlugin,
    render: h => h(App)
}).$mount('#app')
