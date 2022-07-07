<template>            <!-- /.card-header -->
    <TableContent class="py-5" v-if="typeof(dataList) == 'object'" :isDateSearch="isDateSearch" :searchForm="searchForm" :sortingForm="sortingForm" :isAddItem="isAddItem" :isEditBtn="isEditBtn" :isDelBtn="isDelBtn" :isActionBtn="isActionBtn" :cardTitle="cardTitle" :columnsHead="columnsHead" :columnsBody="columnsBody" :dataList="dataList" :showEditForm="showEditForm" :deleteItem="deleteItem" :getDataList="getDataList" :excelFields="excelFields" :excelTitle="excelTitle" :isDownload="isDownload" :isSearchBox="isSearchBox" route="admin"></TableContent>
</template>
<script>
import mixin from '../Mixin/mixin';
export default {
    mixins:[mixin],

    created(){
        this.generalApi = "stocks"
        this.cardTitle ="Stock List"
        this.backUrl = '/stocks'
        this.isDelBtn = false;
        this.isAddItem = false;
          this.isEditBtn = false;
        this.isFile = true;
        this.columnsHead.push(
          'SL#',
          'Name',
          'Category',
          'Cost Price',
          'Selling Price',
          'Total Quantity',
          'Date',
          'Action'
        )

        this.columnsBody.push(
        'product_name',
        'category_name',
        'purchase_price',
        'selling_price',
        'stock_quantity',
        'created_at')
        // this.columnsBodyExtra =
       this.isDownload = true
        this.excelFields = {
          "Name" : "product_name",
          "Category": "category_name",
          "Cost Price": "purchase_price",
          "Selling Amount": "selling_price",
          "Total Quantity": "stock_quantity",
          "Created at": "created_at"
        }

    }
}
</script>
