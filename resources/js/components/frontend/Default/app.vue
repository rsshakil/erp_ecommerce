
<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-0">
        <navbar :app="this"></navbar>
        </div>
     
        <div class="col-md-12">
            <router-view/>
        </div>
        <!-- <spinner v-if="loading"></spinner>
        <div v-else-if="initiated"></div> -->
        <div class="col-md-12" style="margin-top:70px; padding:0px;">
            <projectfooter :app="this"></projectfooter>
        </div>
        
        
    </div>
</div>
</template>

<script>
import navbar from './navbar'
import projectfooter from './project_footer'
export default {
name:'app',
components:{
navbar,
projectfooter,
},
data(){
    return{
        user:null,
        loading:false,
        initiated:false,
        BASE_URL:Globals.base_url,
        req: axios.create({
            baseUrl:Globals.base_url
        })
    }
},
methods:{
  
},
created(){
    console.log("app.vue loaded");
}
}
</script>