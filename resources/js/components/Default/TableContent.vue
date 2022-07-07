<template>
    <div class="row py-3">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-4">
            <div class="card">
                <div class="card-header">
                     <h5 class="card-title">{{ cardTitle }}</h5>

                </div>
                <div class="card-body">
                    
                    <router-link :to="this.$route.path+'/create'" class="btn btn-sm btn-primary float-right m-1" v-if="isAddItem">Add New</router-link>
                    <v-select @input="getDataList" :isSorting="isSorting" v-model="sortingForm.sorting_item" class="col-md-2 float-right m-1" :options="sortingData" :reduce="sorting => sorting.count_num" label="count_num" placeholder="Sort Item"></v-select>

                    <downloadExcel :style="isDownload == false?'display:none':''" class="btn btn-sm btn-success float-right m-1" :data="dataList.data" :fields="excelFields"  :name="cardTitle"></downloadExcel>
                    <button class="btn btn-primary active float-right srchBtn" type="button" @click="getDataList()">Search</button>
                    <input type="text" style="width:200px;margin-top:3px;" v-model="searchForm.search" class="form-control float-right" placeholder="Search">
                    
                    <flat-pickr v-if="isDateSearch" v-model="searchForm.start_date"/>
                    <flat-pickr v-if="isDateSearch" v-model="searchForm.end_date"/>
                   
                   
                    <table class="table table-bordered customDataTable table-responsive w-100 d-block d-md-table table-response">
                        <thead>
                            <tr class="table-primary customsTh">
                                <td  v-for="(thead, i) in columnsHead"  :key="i">{{ thead }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in dataList.data" :key="index" v-if="!item.isComplete">
                                <td>{{ dataList.meta.from +index }}</td>
                                <td v-for="(tbody, i) in columnsBody.slice(0, columnsBody.length)" :key="i" v-html="item[tbody]">

                                </td>
                                
                                <td class="text-center" v-if="isActionBtn">
                                    <a href="#" v-if="isEditBtn" @click.prevent="showEditForm(item.id)"
                                        class="btn btn-success btn-circle btn-xs">
                                            <b-icon icon="pencil-square" font-scale="1.2"></b-icon>
                                    </a>
                                    <a href="#" v-if="isDelBtn" @click.prevent="deleteItem(item.id)"
                                        class="btn btn-circle btn-xs" :class="item.deleted_at==null?'btn-danger':'btn-info'">
                                        <!-- <i class="fas fa-trash" v-if="item.deleted_at==null"></i> -->
                                        <b-icon icon="trash" v-if="item.deleted_at==null" font-scale="1.2"></b-icon>
                                        <b-icon icon="arrow-counterclockwise" font-scale="1.2" v-else></b-icon>
                                        <!-- <i class="fas fa-reset" v-else></i> -->
                                    </a>
                                </td>

                            </tr>
                            <tr v-else><td :colspan="columnsHead.length" class="text-danger text-center">There is no record available!</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <pagination class="pagination pagination-sm m-0 float-right" :data="dataList"
                        @pagination-change-page="getDataList"></pagination>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'isAddItem', 'isEditBtn', 'isDelBtn','isActionBtn', 'cardTitle','columnsHead', 'columnsBody', 'dataList', 'showEditForm', 'deleteItem', 'getDataList', 'excelFields','excelTitle', 'isDownload', 'isSorting','isSearchBox','isMerchantFilter','isStatusList','searchForm', 'isDateSearch', 'sortingForm','updateItem','isFilterByStatus'
            ],

        data(){
            return {
                statusItems: ['active', 'pending', 'rejected'],
                sortingData:[
                    {count_num:15},
                    {count_num:25},
                    {count_num:50},
                    {count_num:100},
                    {count_num:500},
                    {count_num:1000},
                ]
            }
        },
        beforeCreate: function() {
           // Fire.$emit('header_nav');
        },
    }

</script>

