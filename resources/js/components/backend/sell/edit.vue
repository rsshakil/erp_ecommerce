<template>
   
<div class="main-content-container container-fluid" style="padding-left:30px;">
    <!-- Page Header -->
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <!-- <h3 class="page-title">Product Purchase</h3> -->
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    
        <div class="row" id="printArea" v-can="['Admin_view']">
        <div class="col-12 text-center">
           <h2 style="text-align:center">{{clientInfo.first_name}}</h2>
                        <Address style="text-align:center;margin-bottom: 0;">Address: {{clientInfo.last_name}}</Address>
                        <Address style="text-align:center;margin-bottom: 0;">Phone: {{clientInfo.phone}}</Address>
                        </div>
                    <div class="col-md-6 col-lg-6">
                      <p style="text-align:left;margin-bottom: 0;">Name: {{product_list_arr[0].full_name}}</p>
                      <Address style="text-align:left;margin-bottom: 0;">Address: {{product_list_arr[0].address1}}</Address>
                      <Address style="text-align:left;margin-bottom: 0;">Phone: {{product_list_arr[0].phone}}</Address>
                    </div>
                    <div class="col-md-6 col-lg-6" style="text-align: right;float:right;">
                        <Address style="text-align:right;margin-bottom: 0;">Invoice No: {{product_list_arr[0].invoice_no}}</Address>
                        <Address style="text-align:right;margin-bottom: 0;">Invoice Date: {{new Date(product_list_arr[0].created_at).toLocaleDateString()}}</Address>
                    </div>
               <div class="clear-both"></div>
               <div class="col-md-12">
           <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th style="width:200px;">Image</th>
                    <th>Name</th>
                    <th>Caegory</th>
                    <th>Selling price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <!-- <th>Action</th> -->
                </tr>
                </thead>
                <tbody>
                 <tr v-for="(product, i) in product_list_arr" :key="i">
                    <td style="vertical-align:middle">{{(i+1)}}</td>
                    <td style="vertical-align:middle">
                      <img v-if="product.item_img!=null" style="width:100px;height:60px" class="product_image_list" :src="BASE_URL+'/public/images/products/'+product.item_img"/>
                      <img v-else class="product_image_list" style="width:100px;height:60px" :src="BASE_URL+'/public/images/products/no-product-image.png'"/>
                      </td>
                    <td style="vertical-align:middle">{{product.item_name}}</td>
                    <td style="vertical-align:middle">{{product.item_cat}}</td>
                    <td style="vertical-align:middle;text-align: right;">৳{{product.item_selling_price}}</td>
                    <td style="vertical-align:middle;text-align: right;">{{product.item_quantity}}<!--<input style="border:none;background:transparent;text-align: right;" type="number" v-model="product.item_quantity" value="product.item_quantity">--></td>
                    
                    <td style="vertical-align:middle;text-align: right;">৳{{product.item_selling_price*product.item_quantity}}</td>
                    <!-- <td><b-form-button name="removeProductAttr" @click="removeproductattr(i)" variant="danger"
                                class="custom_remove_product_attr">-</b-form-button></td> -->
                </tr>
                <tr>
                    <td colspan="5" style="text-align: right;">Total Quantity</td>
                    <td style="text-align: right;">{{totalQuantity}}</td>
                    <td style="text-align: right;">৳{{totalPrice}}</td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: right;">Total Paid amount</td>
                    <td style="text-align: right;">৳{{product_list_arr[0].total_paid_amount}}</td>
                </tr>
                <tr>
                    <td colspan="6" style="text-align: right;">Total Due amount</td>
                    <td style="text-align: right;">৳{{product_list_arr[0].total_due_amount}}</td>
                </tr>
                </tbody>
           </table>
           </div>
        </div>
        <div class="col-md-12">
          <router-link to="/sell" class="btn btn-primary" style="width:33%;float:left;margin-right:1%;">Back</router-link>
          <router-link :to="'/returnsell/'+$route.params.id"  class="btn btn-primary" style="width:32%;float:left;margin-right:1%;">Return Item</router-link>
          <button class="btn btn-primary" @click="printDiv" style="width:33%;float:left">Print</button>
        </div>



    </div>
</template>
<style>
  tbody tr td{vertical-align: middle;}
</style>
<script>
import mixin from '../Mixin/mixin';
import { Printd } from 'printd';


export default {
     mixins:[mixin],
  data() {
    return {
      clientInfo:{},
      inputData:{
        user_id:'',
        client_id:'',
        contact_id: '',
        product_id:'',
      },
      contact_list:[],
      
    
       product_list_arr:[],
       product_list_arr_select:[],
       search_by:{
         adm_user_id:this.global_user_id,
       },
    };
  },
  methods: {
    upProduct(e,i){
      this.product_list_arr[i].item_quantity=e.target.innerHTML
    },
    updateInvoice(){
      console.log(this.product_list_arr);
    },
printDiv(){
  // const printCss = `
  //   .product_image_list{
  //     width:100px !important;
  //     height:100px !important;
  //     display:none !important;
  //   }
  //   img{
  //     width:100px !important;
  //     height:100px !important;
  //     display:none !important;
  //   }
  // `;
  // const d = new Printd();
  // d.print( document.getElementById('printArea'),printCss)
  this.$htmlToPaper('printArea');
},

    getDetails(id){
      var post_data = {
        client_id: Globals.user_info_client_id,
        sell_id:id
      };
      axios.post(this.BASE_URL+"api/sell_history",post_data)
        .then(({ data }) => {
            this.product_list_arr = data.products;
            this.clientInfo = data.clientInfo;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    
  },

  created() {
      this.generalApi = 'sell'
      this.backUrl = '/sell'

    console.log(this.$route.params.id);
    this.getDetails(this.$route.params.id);

  },
  computed: {

    totalQuantity: function () {
       return this.product_list_arr.reduce((acc, val) => {
           return acc + parseInt(val.item_quantity);
         }, 0);
    },
    totalPrice: function () {
       return this.product_list_arr.reduce((acc, val) => {
           return acc + parseInt(val.item_selling_price*val.item_quantity);
         }, 0);
    },

  },
  mounted() {
    console.log("product page loaded");
  }
};
</script>