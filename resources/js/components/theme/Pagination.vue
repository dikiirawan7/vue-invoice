<template>
    <nav>
        <ul class="pagination pagination-md">
            <li class="page-item" :class="{'disabled':meta_data.prev_page_url === null}">
                <a href="#" class="page-link" @click="next(1)">
                First
                </a>
            </li>
            <li class="page-item" :class="{'disabled':meta_data.prev_page_url === null}">
                <a href="#" class="page-link" @click="next(meta_data.current_page-1)">
                &laquo;
                </a>
            </li>

            <li class="page-item"
            
            v-for="page in meta_data.last_page"
            
            :key="page"
            :class="{'active':meta_data.current_page == page}"
            
            >

            <a v-if="
            Math.abs(page - meta_data.current_page) <2 ||
            ((page===meta_data.current_page+2)&&(page<=3))||
            ((page===meta_data.current_page-2)&&(meta_data.current_page==meta_data.last_page))
            "
            href="#"  
            @click.prevent="next(page)" 
            class="page-link">
                {{page}}
            </a>
            
            </li>
            
            <li class="page-item"
            :class="{'disabled':meta_data.current_page === meta_data.last_page}">

            <a href="#" @click="next(meta_data.current_page+1)" class="page-link">
                &raquo;
            </a>
            
            </li>
            <li class="page-item"
            :class="{'disabled':meta_data.current_page === meta_data.last_page}">

            <a href="#" @click="next(meta_data.last_page)" class="page-link">
                Last
            </a>
            
            </li>
        </ul>
    </nav>
</template>

<script>
import NProgress from 'nprogress';
export default {

    props :['meta_data'],
    methods:{
        next(page){
     NProgress.start();
           var done= this.$emit('next',page);
            if(done){
                NProgress.done();
            }
          
            
        }
    }
}
</script>
