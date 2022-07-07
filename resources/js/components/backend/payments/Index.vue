<template>            <!-- /.card-header -->
    <TableContent class="py-3" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../Mixin/mixin';

export default {
    mixins:[mixin],

    created(){
        this.generalApi = "payments"
        this.cardTitle ="Payment/Receive"
    
        this.isAddItem = true;
        this.isEditBtn = false;
        this.isDelBtn = false;
        this.columnsHead.push('Sn','Name','Phone','Amount', 'Bank name','Checque no','Type','Action')
        this.columnsBody.push('full_name','phone','amount','bank_name','checque_no','type')  
    }
}
</script>