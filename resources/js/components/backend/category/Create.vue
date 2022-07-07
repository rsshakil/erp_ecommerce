<template>
    <div>
        <form class="form" @submit.prevent="processData()">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ cardTitle }}</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Category Name</label>
                                        <input type="hidden" name="client_id" v-model="inputData.client_id"/>
                                        <input type="text" name="cat_name" class="form-control" v-model="inputData.cat_name" placeholder="Category Name">
                                    </div>
                                </div><!--col-6 end-->

                            </div>
                        </div>
                        <div class="card-footer">
                           <FormButton :isEdit="isEdit" :backUrl="backUrl"></FormButton>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import mixin from '../Mixin/mixin';

    export default {
        mixins: [mixin],
        data(){
            return {
               smList:[],

                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                regions:[],
            }
        },
        created() {
           
            this.generalApi = 'category'
            this.backUrl = '/category'
            this.inputData.client_id = Globals.user_info_client_id
            
            console.log(this.inputData);
            
            this.cardTitle = this.isEdit ? 'Edit Category' : 'Add Category'
           
        },

        methods:{
           
        },


    }

</script>