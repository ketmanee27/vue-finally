import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'
import VueThailandAddress from 'vue-thailand-address'
import { VueperSlides, VueperSlide } from 'vueperslides'
import 'vueperslides/dist/vueperslides.css'

Vue.use(Vuetify)
Vue.use(VueThailandAddress)

Vue.use(VueperSlides, VueperSlide)

export default new Vuetify({
})
