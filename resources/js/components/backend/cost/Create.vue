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
                                        <label for="">Cost Name</label>
                                        <input type="hidden" name="client_id" class="form-control" v-model="inputData.client_id" placeholder="Cost Name">
                                        <input type="text" name="cost_name" class="form-control" v-model="inputData.cost_name" placeholder="Cost Name">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cost Amount</label>
                                        <input type="number" name="cost_amount" class="form-control" v-model="inputData.cost_amount" placeholder="Cost Amount">
                                    </div>
                                </div><!--col-6 end-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Cost Category</label>
                                        <v-select 
                                            :options="Categories" 
                                            :reduce="eventCategory => eventCategory.id" 
                                            label="cat_name" 
                                            v-model="inputData.category_id" 
                                            placeholder="Select Category"></v-select> 
                                            <input type="hidden" name="cat_id" v-model="inputData.category_id">
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
                Categories:[],
                smOptions:[
                    {role:'Asst.SM'},
                    {role:'RSM'},
                    {role:'Sr.RSM'},
                ],
                regions:[],
                
            }
        },
        created() {
           
            this.generalApi = 'cost'
            this.backUrl = '/cost'
            this.isFile = true
            this.inputData.client_id = Globals.user_info_client_id
            
            
            this.cardTitle = this.isEdit ? 'Edit Cost' : 'Add Cost'

            axios.get(this.url+'/api/cost_category_list/'+ Globals.user_info_client_id)
            .then(res => {
               console.log(res.data);
               this.Categories = res.data.data;
            })
           
        },

        methods:{
           
        },


    }

</script>