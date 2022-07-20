<template>
   
<div class="card card-body">
    <!-- Page Header -->
    <div class="page-header row no-gutters py0">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <!-- <span class="text-uppercase page-subtitle">Overview</span> -->
            <h3 class="page-title">Product List</h3>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- Default Light Table -->
    
        <div class="row" v-can="['Admin_view']">
            <div class="col-12 text-right">
    <router-link class="btn btn-primary" :to="{ name: 'add_product', params: { product_type: 1 }}">{{myLang.add_goods}}</router-link>
  <!-- <b-button variant="outline-secondary">{{myLang.imports}}</b-button> -->
  <!-- <b-button variant="outline-secondary">{{myLang.imports}}</b-button> -->
            </div>
            <div class="col-12">
           <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th style="width:200px;">Image</th>
                    <th >{{myLang.product_code}}</th>
                    <th>Name</th>
                    <th>Caegory</th>
                    <th>Cost price</th>
                    <!-- <th>More</th> -->
                </tr>
                </thead>
                <tbody>
                 <tr v-for="(product, i) in product_list_arr" :key="i">
                    <td>{{(i+1)}}</td>
                    <td>
                      <img v-if="product.prodcut_image!=null" class="product_image_list" :src="BASE_URL+'/public/images/products/'+product.prodcut_image"/>
                      <img v-else class="product_image_list" :src="BASE_URL+'/public/images/products/no-product-image.png'"/>
                      </td>
                    <td>{{product.product_code}}</td>
                    <td>{{product.product_name}}</td>
                     <td>{{product.category_name}}</td>
                    <td style="text-align:right;">৳ {{product.p_cost_price}}</td>
                    <!-- <td>
                        <b-dropdown right split text="More" class=" custom_more_dropdown">
      <b-dropdown-item>Edit</b-dropdown-item>
      <b-dropdown-item>Delete</b-dropdown-item>
      <b-dropdown-divider></b-dropdown-divider>
      <b-dropdown-item>Send</b-dropdown-item>
    </b-dropdown>
                    </td> -->
                </tr>
                </tbody>
           </table>
           </div>
        </div>



    </div>
</template>
<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
export default {
 
  data() {
    return {
     
            options:[],
      editor: ClassicEditor,
                editorData: '<p>Content of the editor.</p>',
                editorConfig: {
                    // The configuration of the editor.
                },
       product_list_arr:{},
       search_by:{
         adm_user_id:this.global_user_id,
       },
       add_update_product_modal:false,
       category_list:{},
       selected_product_categorie_id:'',
       selected_sub_product_categorie_id:'',
       selected_item_type:0,
       description_type:1,
       sub_category_list:{},
       brand_list:{},
       manufacturer_list:{},
        product_attribute: {
            product_attr_id:'',
            item_code:'',
            cost_price: '',
            retail_price: '',
            wholesale_price: '',
            color: '',
            size: '',
            weight: '',
            diemension: '',
        },
        product_attributes: [{
            product_attr_id:'',
            item_code: '',
            cost_price: '',
            retail_price: '',
            wholesale_price: '',
            color: '',
            size: '',
            weight: '',
            diemension: '',
        },],

    };
  },
  methods: {
  
    //get Table data
    loadProductData() {
      var post_data = {
        client_id: Globals.user_info_client_id,
      };
      axios.post(this.BASE_URL+"api/get_all_products",post_data)
        .then(({ data }) => {
            this.product_list_arr = data.products;
        })
        .catch(() => {
          console.log("Error...");
        });
    },

    //getcategory
    loadProductCategoryData() {
      axios.get(this.BASE_URL+"api/get_all_product_category")
        .then(({ data }) => {
            console.log(data);
            this.category_list = data.category_list;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    showsubcatlist(data){
        console.log(data);
        this.selected_sub_product_categorie_id='';
        this.loadProductSubCategoryData(data.product_categorie_id);
    },
    //getcategory
    loadProductSubCategoryData(category_id) {
      axios.get(this.BASE_URL+"api/get_all_product_sub_category/"+category_id)
        .then(({ data }) => {
            console.log(data);
            this.sub_category_list = data.sub_category_list;
        })
        .catch(() => {
          console.log("Error...");
        });
    },
    
  },

  created() {
    //LoadTableData
    this.loadProductData();
    //this.loadProductCategoryData();
    //this.loadProductSubCategoryData();
    //this.loadProductbrandData();
    //this.loadProductManufacturerData();
  },
  mounted() {
    console.log("product page loaded");
  }
};
</script>