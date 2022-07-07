<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../Mixin/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "sell"
        this.cardTitle ="Sell List"
        this.backUrl = '/sell'
        this.isDelBtn = false;
            this.isFile = true
        this.columnsHead.push(
          'SL#',
          'Invoice No',
          'Total Quantity',
          'Total Amount',
          'Paid Amount',
          'Due Amount',
          'Date',
          'Action'
        )

        this.columnsBody.push(
        'invoice_no',
        'total_quantity',
        'total_amount',
        'total_paid_amount',
        'total_due_amount',
        'created_at')
        // this.columnsBodyExtra =
       this.isDownload = true
        this.excelFields = {
          "Invoice No" : "invoice_no",
          "Total Quanttity": "total_quantity",
          "Total Amount": "total_amount",
           "Paid Amount": "total_paid_amount",
          "Due Amount": "total_due_amount",
          "Created at": "created_at"
        }

    }
}
</script>
