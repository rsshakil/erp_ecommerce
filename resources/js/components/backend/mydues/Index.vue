<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../Mixin/mixin';

export default {
    mixins:[mixin],

    created(){
       this.generalApi = "mydues"
        this.cardTitle ="My Due Info"
    
        this.isAddItem = false;
this.isEditBtn = false;
this.isDelBtn = false;
        this.columnsHead.push('Sn','Name','Phone','Paid amount', 'Due Amount', 'Action')
        this.columnsBody.push('full_name','phone','paid_amount','due_amount')  
    }
}
</script>