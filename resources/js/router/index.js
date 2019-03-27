import Vue from 'vue'
import Router from 'vue-router'
import VueAxios from 'vue-axios'
import Axios from 'axios'
import example from '../components/ExampleComponent.vue';
import ManajemenProduk from '../components/content/Produk.vue';
import ManajemenCustomer from '../components/content/Customer.vue';
import CreateInvoice from '../components/content/CreateInvoice.vue';
import EditInvoice from '../components/content/EditInvoice.vue';
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
        {
            path:'/customers',
            name:'ManageCustomer',
            component:ManajemenCustomer
        },
        {
            path:'/CreateInvoice',
            name:'Buat Invoice',
            component:CreateInvoice
        },
        {
            path:'/EditInvoice/:id',
            name:'EditInvoice',
            component:EditInvoice
        },
    ],
    linkExactActiveClass: "active"
});
