require('./bootstrap');

import App from './App.vue';
import router from './router';
import store from './store';
import VueSweetalert2 from 'vue-sweetalert2';

import Npcss from '../../node_modules/nprogress/nprogress.css'
window.Vue = require('vue');
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
  }
Vue.use(Npcss);
Vue.use(VueSweetalert2, options);




Vue.config.productionTip = false

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});
