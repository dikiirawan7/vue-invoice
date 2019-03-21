<template>
    <div>
        <headernya></headernya>
        <router-view></router-view>
    </div>
</template>
<style>
#nprogress .bar {
background: #fd0404 !important;
}
</style>


<script>
import headernya from './components/theme/Header.vue'
export default {
    components:{
        headernya
    }
}
</script>
