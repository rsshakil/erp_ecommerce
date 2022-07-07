<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" :isStatusList="isStatusList" :updateItem="updateItem" :isFilterByStatus="isFilterByStatus" :isMerchantFilter="isMerchantFilter" route="admin"></TableContent>
</template>
<script>
import mixin from '../../Mixin/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "merchants"
        this.cardTitle ="Merchant List"
        this.isMerchantFilter = true;
        this.columnsHead.push(
          'SL#',
          'Merchant Name',
          'Company Name',
          'Email',
          'Area',
        //   'Status',
          'Status',
          'Action'
        )

        this.columnsBody.push(
        'merchant_name',
        'company_name',
        'email',
        'area_name')
        // this.columnsBodyExtra =
       this.isDownload = true
        this.excelFields = {
                "Merchant Name" : "merchant_name",
                "Company Name": "company_name",
                "email": "email",
                "Area": "area_name",
                "Status" : "status"

        }

    }
}
</script>
