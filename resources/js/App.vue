<template>
    <div>
        <headernya></headernya>
        <router-view></router-view>
    </div>
</template>



<script>
import headernya from './components/theme/Header.vue'
export default {
    components:{
        headernya
    }
}
</script>
