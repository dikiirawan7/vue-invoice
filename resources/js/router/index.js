import Vue from 'vue'
import Router from 'vue-router'
import VueAxios from 'vue-axios'
import Axios from 'axios'
import example from '../components/ExampleComponent.vue';
import ManajemenProduk from '../components/content/Produk.vue';
import ManajemenCustomer from '../components/content/Customer.vue';
import CreateInvoice from '../components/content/CreateInvoice.vue';
import EditInvoice from '../components/content/EditInvoice.vue';
import ListInvoice from '../components/content/ListInvoice.vue';
import Login from '../components/tesauth/Login.vue';
import Dashboard from '../components/tesauth/DashboardComponent.vue';
import Logout from '../components/tesauth/LogoutComponent.vue';

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
            component:example,
            meta: { requiresAuth: true }  
        },
        {
            path:'/produk',
            name:'ManageProduk',
            component:ManajemenProduk,
            meta: { requiresAuth: true }  // add this
        },
        {
            path:'/customers',
            name:'ManageCustomer',
            component:ManajemenCustomer,
            meta: { requiresAuth: true }  
        },
        {
            path:'/CreateInvoice',
            name:'Buat Invoice',
            component:CreateInvoice,
            meta: { requiresAuth: true }  
        },
        {
            path:'/EditInvoice/:id',
            name:'EditInvoice',
            component:EditInvoice,
            meta: { requiresAuth: true }  
        },
        {
            path:'/listinvoice',
            name:'ListInvoice',
            component:ListInvoice,
            meta: { requiresAuth: true }  
        },
        {
            path:'/login',
            name:'login',
            component:Login
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { requiresAuth: true }  // add this
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout
        }
    ],
    linkExactActiveClass: "active"
});

