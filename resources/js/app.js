require('./bootstrap');

import App from './App.vue';
import router from './router';
import store from './store';
import VueSweetalert2 from 'vue-sweetalert2';
import VeeValidate from 'vee-validate';

import Npcss from '../../node_modules/nprogress/nprogress.css'
window.Vue = require('vue');
const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674'
  }
Vue.use(Npcss);
Vue.use(VueSweetalert2, options);

Vue.use(VeeValidate);




Vue.config.productionTip = false
router.beforeEach((to, from, next) => {

  // check if the route requires authentication and user is not logged in
  if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
      // redirect to login page
      next({ name: 'login' })
      return
  }

  // if logged in redirect to dashboard
  if(to.path === '/login' && store.state.isLoggedIn) {
      next({ name: 'dashboard' })
      return
  }

  next()
})

new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
});
