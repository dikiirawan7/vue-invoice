import Vue from 'vue'
import Router from 'vue-router'
import VueAxios from 'vue-axios'
import Axios from 'axios'
import example from '../components/ExampleComponent.vue';
import ManajemenProduk from '../components/content/Produk.vue';

Vue.use(VueAxios, Axios)
Vue.use(Router)

export default new Router({
    mode: 'history',
    base: process.env.BASE_URL,
    routes:
    [
        {
            path:'/produk/tes',
            name:'HelloWorld',
            component:example
        },
        {
            path:'/produk',
            name:'ManageProduk',
            component:ManajemenProduk
        },
    ],
    linkExactActiveClass: "active"
});
