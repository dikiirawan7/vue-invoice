<template>
    <div>
        <headernya v-show="lihat"></headernya>
        <headerlogin v-show="lihatlogin"></headerlogin>
        <router-view></router-view>
    </div>
</template>
<style>
#nprogress .bar {
background: #fd0404 !important;
}
</style>


<script>
import store from './store'
import headernya from './components/theme/Header.vue'
import headerlogin from './components/theme/HeaderLogin.vue'

export default {
    components:{
        headernya,
        headerlogin
    },
    data(){
        return{
            lihat:false,
            lihatlogin:true,
        }
    },
    created() {

            if(localStorage.token) {
                axios.get('/api/user', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token') 
                    },
                    
                    
                },
                ).then(response => {
                    store.commit('loginUser')
                   
                   
                }).catch(error => {
                    if (error.response.status === 401 || error.response.status === 403) {
                        store.commit('logoutUser')
                        localStorage.setItem('token', '')
                        this.$router.push({name: 'login'})
                    }

                });
            }

        },
        watch: {
             $route: function() {
            // Check if given route is true, if it is then hide Nav. 
            if (this.$route.path === "/login") {
                this.lihat=false;
                this.lihatlogin=true;
            }
            else{
                this.lihat=true;
                this.lihatlogin=false;
            }
        }
        },
}
</script>
