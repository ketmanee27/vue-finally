
import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import VueThailandAddress from 'vue-thailand-address/dist/vue-thailand-address.css'
import VueCookies from 'vue-cookies'
import axios from 'axios'
import VueAxios from 'vue-axios'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.config.productionTip = false
Vue.use(require('vue-cookies'))
Vue.use(VueCookies, { expire: '7d' })
Vue.use(VueAxios, axios)
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyDp3Ud3SixagW8bJOwtosy5bBMB5JRNS_k'
  }
})

new Vue({
  router,
  store,
  vuetify,
  VueThailandAddress,
  render: h => h(App)
}).$mount('#app')
