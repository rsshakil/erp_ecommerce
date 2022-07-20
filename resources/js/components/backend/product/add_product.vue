<template>

    <div class="main-content-container jumbotron container-fluid px-4">
        <div class="row" v-can="['Admin_view']">
            <div class="col-md-12">
                 <div class="row form-group">
                    <div class="col-md-12">
                        <b-form-group label="">
                            <b-form-radio-group id="radio-group-2" v-model="inputData.selected_item_type"
                                name="radio-sub-component">
                                <b-form-radio value="0">Single Item</b-form-radio>
                                <b-form-radio value="1">Multiple Item</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12" v-show="inputData.selected_item_type!=0">
                    <table class="table custom_header">
                        <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Cost Price</th>
                            
                            <th>wholesale</th>
                            <th>Retail</th>
                             <th>Weight</th>
                            <th>Diemension</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    <div class="col-md-12">
                   

                        <b-input-group v-if="inputData.selected_item_type==0" class="mb-2 mr-sm-2 mb-sm-0">
                         <table class="table custom_header">
                        <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Cost Price</th>
                           
                            
                            <th>wholesale</th>
                            <th>Retail</th>
                             <th>Weight</th>
                            <th>Diemension</th>
                        </tr>
                        </thead>
                    </table>
                           <b-form-input v-model="inputData.singleitem.item_code" @input="handleItemCodeInput" :class="{ 'hasError': $v.inputData.singleitem.item_code.$error }" name="item_code" type="text" placeholder="Product Code">
                        </b-form-input>
                            <b-form-input v-model="inputData.singleitem.cost_price" type="number" :class="{ 'hasError': $v.inputData.singleitem.cost_price.$error }" name="cost_price" placeholder="Cost Price">
                            </b-form-input>
                           
                            <b-form-input v-model="inputData.singleitem.wholesale_price" type="number" :class="{ 'hasError': $v.inputData.singleitem.wholesale_price.$error }" name="wholesale_price"
                                placeholder="wholesale Price"></b-form-input>
                                 <b-form-input v-model="inputData.singleitem.retail_price" type="number" :class="{ 'hasError': $v.inputData.singleitem.retail_price.$error }" name="retail_price" placeholder="Retail Price">
                            </b-form-input>
                            <b-form-input v-model="inputData.singleitem.weight" name="weight" placeholder="Weight"></b-form-input>
                            <b-form-input v-model="inputData.singleitem.diemension" name="diemension" placeholder="Diemension">
                            </b-form-input>
                        </b-input-group>

                        <b-input-group v-for="(product_attr, index) in inputData.multipleitem.product_attributes"
                            :key="product_attr.product_attr_id" v-if="inputData.selected_item_type==1"
                            class="mb-2 mr-sm-2 mb-sm-0">
                             
                          <b-form-input v-model="inputData.multipleitem.item_code" @input="handleItemCodeInput" name="item_code" :class="{ 'hasError': $v.inputData.multipleitem.item_code.$error }" type="text" placeholder="Product Code">
                        </b-form-input>
                            <b-form-input v-model="inputData.multipleitem.product_attributes[index].color" :class="{ 'hasError': $v.inputData.multipleitem.product_attributes.$each[index].color.$error }" name="color[]"
                                placeholder="color"></b-form-input>
                            <b-form-input v-model="inputData.multipleitem.product_attributes[index].size" :class="{ 'hasError': $v.inputData.multipleitem.product_attributes.$each[index].size.$error }" name="size[]"
                                placeholder="Size"></b-form-input>
                            <b-form-input type="number" v-model="inputData.multipleitem.product_attributes[index].cost_price" @input="handleCostPriceInput" :class="{ 'hasError': $v.inputData.multipleitem.product_attributes.$each[index].cost_price.$error }" name="cost_price[]"
                                placeholder="Cost Price"></b-form-input>
                           
                            <b-form-input type="number" v-model="inputData.multipleitem.product_attributes[index].wholesale_price" @input="handleWholesalePriceInput" :class="{ 'hasError': $v.inputData.multipleitem.product_attributes.$each[index].wholesale_price.$error }"
                                name="wholesale_price[]" placeholder="wholesale Price"></b-form-input>
                                 <b-form-input type="number" v-model="inputData.multipleitem.product_attributes[index].retail_price" @input="handleRetailPriceInput" :class="{ 'hasError': $v.inputData.multipleitem.product_attributes.$each[index].retail_price.$error }" name="retail_price[]"
                                placeholder="Retail Price"></b-form-input>
                            <b-form-input v-model="inputData.multipleitem.product_attributes[index].weight"  name="weight[]"
                                placeholder="Weight"></b-form-input>
                            <b-form-input v-model="inputData.multipleitem.product_attributes[index].diemension" name="diemension[]"
                                placeholder="Diemension"></b-form-input>
                            <b-form-button name="addProductAttr" v-if="index==0" @click="addNewproductattr(index)"
                                class="custom_add_new_product_attr"> +</b-form-button>
                            <b-form-button name="removeProductAttr" v-else @click="removeproductattr(index)" variant="danger"
                                class="custom_remove_product_attr">-</b-form-button>
                        </b-input-group>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label">Product Name</label>
                    <div class="col-md-8">
                        <b-form-input v-model="inputData.product_name" name="product_name" type="text" :class="{ 'hasError': $v.inputData.product_name.$error }" placeholder="Product Name">
                        </b-form-input>
                    </div>
                </div>


                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Supplier</label>
                    <div class="col-md-8">
                        <multiselect v-model="inputData.contact_id" :options="contact_list"
                            label="full_name" track-by="contact_id" :searchable="true" :multiple="false"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true" :class="{ 'hasError': $v.inputData.contact_id.$error }"
                            open-direction="bottom" placeholder="Pick a supplier">
                        </multiselect>
                    </div>
                    
                </div>

                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Category</label>
                    <div class="col-md-8">
                        <multiselect v-model="inputData.selected_product_categorie_id" :options="category_list"
                            label="category_name" track-by="product_categorie_id" :searchable="true" :multiple="false"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true" :class="{ 'hasError': $v.inputData.selected_product_categorie_id.$error }"
                            open-direction="bottom" @input="showsubcatlist($event)" placeholder="Pick a Categry">
                        </multiselect>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Sub Category</label>
                    <div class="col-md-8">
                        <multiselect v-model="inputData.selected_sub_product_categorie_id" :options="sub_category_list"
                            label="sub_category_name" track-by="product_categorie_id" :searchable="true" :class="{ 'hasError': $v.inputData.selected_sub_product_categorie_id.$error }"
                            :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                            open-direction="bottom" placeholder="Pick a sub Categry"></multiselect>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Manufacturer/Vendor</label>
                    <div class="col-md-8">
                        <multiselect v-model="inputData.selected_manufacture_id" :options="manufacturer_list"
                            label="name" track-by="type_control_id" :searchable="true" :multiple="false" :class="{ 'hasError': $v.inputData.selected_manufacture_id.$error }"
                            :close-on-select="true" :clear-on-select="false" :preserve-search="true"
                            open-direction="bottom" placeholder="Pick a Manufacturer">
                        </multiselect>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Brand</label>
                    <div class="col-md-8">
                        <multiselect v-model="inputData.selected_brand_id" :options="brand_list"
                            label="name" track-by="type_control_id" :searchable="true"
                            :multiple="false" :close-on-select="true" :clear-on-select="false" :preserve-search="true" :class="{ 'hasError': $v.inputData.selected_brand_id.$error }"
                            open-direction="bottom" placeholder="Pick a Brand"></multiselect>
                    </div>
                </div> -->
                
                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Min Qty</label>
                    <div class="col-md-8">
                        <b-form-input v-model="inputData.min_qty" type="number" placeholder="Enter Min Qty"></b-form-input>
                    </div>
                </div>

                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Warranty</label>
                    <div class="col-md-8">
                        <b-form-input v-model="inputData.warrenty" placeholder="Enter product warrenty"></b-form-input>
                       
                    </div>
                </div>

                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Review suggestion for Customer</label>
                    <div class="col-md-8">
                        <b-form-input v-model="review_item" style="width:300px;float:left;" placeholder="Enter default review options"></b-form-input>
                        <b-button style="margin:0;" @click="addReview()">+</b-button>
                        <br>
                        <div class="clearfix"></div>
                        <ul  class="support_review">
    <li v-for="(review_item_list, index) in inputData.review_item_lists" :key="index">
      {{ review_item_list.review_item }} <span class="itemRemove" v-on:click="deleteReview(index)">{{review_item_list.delete}}</span>
    </li>
  </ul>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-4 col-form-label">Support suggestion for Support Ticket</label>
                    <div class="col-md-8">
                        <b-form-input v-model="support_item" style="width:300px;float:left;" placeholder="Enter default support options"></b-form-input>
                        <b-button style="margin:0;" @click="addSupport()">+</b-button>
                         <br>
                          <div class="clearfix"></div>
                        <ul class="support_review">
    <li v-for="(support_item_list, index) in inputData.support_item_lists" :key="index">
      {{ support_item_list.support_item }} <span class="itemRemove" v-on:click="deleteSupport(index)">{{support_item_list.delete}}</span>
    </li>
  </ul>
                    </div>
                </div>

               
               

                <div class="form-group row">
                    <div class="col-md-12">
                        <b-form-group label="">
                            <b-form-radio-group id="description_yes_no" v-model="inputData.description_type"
                                name="description_yes_no">
                                <b-form-radio value="0">Show Description</b-form-radio>
                                <b-form-radio value="1">Hide Description</b-form-radio>
                            </b-form-radio-group>
                        </b-form-group>
                        <div class="clearfix"></div>
                        <div class="col-12">
                            <div v-if="inputData.description_type==0" class="ckeditor">
                                <ckeditor :editor="editor" v-model="inputData.editorData" :config="editorConfig"></ckeditor>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">


                    <div class="model" v-show="model" @click="model = false">
                        <div class="model-show">
                            <img :src="modelSrc" alt="">
                        </div>
                    </div>

                    
                    <div class="cut" v-show="canvas_view">
                        <vue-cropper ref="cropper" :img="option.img" :output-size="option.size"
                            :output-type="option.outputType" :info="true" :full="option.full" :fixed="fixed"
                            :fixed-number="fixedNumber" :can-move="option.canMove" :can-move-box="option.canMoveBox"
                            :fixed-box="option.fixedBox" :original="option.original" :auto-crop="option.autoCrop"
                            :auto-crop-width="option.autoCropWidth" :auto-crop-height="option.autoCropHeight"
                            :center-box="option.centerBox" @real-time="realTime" :high="option.high" @img-load="imgLoad"
                            :max-img-size="option.max" @crop-moving="cropMoving" mode="cover"></vue-cropper>
                    </div>
                    <!-- <div class="show-preview" :style="{'width': previews.w + 'px', 'height': previews.h + 'px',  'overflow': 'hidden', 'margin': '5px'}">
      <div :style="previews.div">
        <img :src="previews.url" :style="previews.img">
      </div>
    </div>-->
                    <div class="test-button">
                        <!--<button @click="changeImg" class="btn">changeImg</button>-->
                        <label class=" btnUpload" for="uploads">Image Upload</label>
                        <input type="file" id="uploads" style="position:absolute; clip:rect(0 0 0 0);"
                            accept="image/png, image/jpeg, image/gif, image/jpg" @change="uploadImg($event, 1)">
                        <button @click="startCrop" v-if="!crap" class="btn_upload_img">start</button>
                        <button @click="stopCrop" v-else class="btn_upload_img">stop</button>
                        <button @click="clearCrop" class="btn_upload_img">clear</button>
                        <button @click="refreshCrop" class="btn_upload_img">refresh</button>
                        <button @click="changeScale(1)" class="btn_upload_img">+</button>
                        <button @click="changeScale(-1)" class="btn_upload_img">-</button>
                        <button @click="rotateLeft" class="btn_upload_img">rotateLeft</button>
                        <button @click="rotateRight" class="btn_upload_img">rotateRight</button>
                        <button @click="addmoreImg('base64')" class=" btnCroped">Crop</button>
                        <!--<button @click="finish('base64')" class="btn">preview(base64)</button>
      <button @click="finish('blob')" class="btn">preview(blob)</button>
      <a @click="down('base64')" class="btn">download(base64)</a>
      <a @click="down('blob')" class="btn">download(blob)</a>-->

                    </div>

                    <div class="uploadedImgList">
                        <ul class="list-inline">
                            <li v-for="(img_list,index) in inputData.img_lists" :key="index">
                                <div class="upsImageOntent">
                                <span class="deleteCropimgicon" @click="deleteCropImg(index)">X</span>
                                <img :src="img_list.img" />
                                </div>
                            </li>
                        </ul>
                    </div>






                </div>


            </div>
        </div>

        <div class="productAddbottom text-right">
          <button @click="productAddUpdate" class="btn btn-success submitProduct">Submit</button>
        </div>


    </div>
</template>
<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    import { required, email, minLength,requiredIf } from "vuelidate/lib/validators";
    export default {

        data() {
            return {
                inputData:{
                    user_id:'',
                    client_id:'',
                    selected_product_categorie_id: '',
                    selected_sub_product_categorie_id: '',
                    selected_manufacture_id: '',
                    selected_brand_id: '',
                    contact_id: '',
                    review_item_lists:[],
                    support_item_lists:[],
                    selected_item_type: 0,
                    min_qty:'',
                    product_type:'',
                    singleitem:{
                      item_code:'',
                      cost_price:'',
                      retail_price:'',
                      wholesale_price:'',
                      diemension:'',
                      weight:'',
                    },
                    multipleitem:{
                        item_code:'',
                       product_attributes: [{
                        product_attr_id: '',
                        cost_price: '',
                        retail_price: '',
                        wholesale_price: '',
                        color: '',
                        size: '',
                        weight: '',
                        diemension: '',
                    }, ],
                    },
                    img_lists: [],
                    editorData: '<p>Content of the editor.</p>',
                    description_type: 1,
                    product_name:'',
                },
                model: false,
                modelSrc: '',
                crap: false,
                previews: {},
                canvas_view:false,
                lists: [{
                    img: '',
                }],
                
                option: {
                    img: '',
                    size: 1,
                    full: false,
                    outputType: 'png',
                    canMove: true,
                    fixedBox: false,
                    original: false,
                    canMoveBox: true,
                    autoCrop: true,
                    // 只有自动截图开启 宽度高度才生效
                    autoCropWidth: 800,
                    autoCropHeight: 800,
                    centerBox: false,
                    high: true,
                    max: 99999
                },
                show: true,
                fixed: true,
                fixedNumber: [16, 16],
                // options: {},
                editor: ClassicEditor,
                
                editorConfig: {
                    // The configuration of the editor.
                },

                contact_list: [],
                category_list: [],
                sub_category_list: [],
                brand_list: [],
                manufacturer_list: [],
                
                review_item:'',
                support_item:'',
                product_attribute: {
                    product_attr_id: '',
                    cost_price: '',
                    retail_price: '',
                    wholesale_price: '',
                    color: '',
                    size: '',
                    weight: '',
                    diemension: '',
                },
               

            };
        },
        methods: {

            handleItemCodeInput(){
                if(this.inputData.selected_item_type=='0'){
                    this.inputData.product_name = this.inputData.singleitem.item_code;
                }else{
                   this.inputData.product_name = this.inputData.multipleitem.item_code; 
                }
            },

            handleCostPriceInput(){
                this.product_attribute.cost_price = this.inputData.multipleitem.product_attributes[0].cost_price;
            },

            handleWholesalePriceInput(){
                this.product_attribute.wholesale_price = this.inputData.multipleitem.product_attributes[0].wholesale_price;
            },

            handleRetailPriceInput(){
                this.product_attribute.retail_price = this.inputData.multipleitem.product_attributes[0].retail_price;
            },

                /*add delete review and support*/
                addReview: function(){
    	let todo = {review_item: this.review_item, delete: 'X'};
        
      this.inputData.review_item_lists.push(todo );
      this.review_item = '';
    },
    deleteReview: function(index){
      this.inputData.review_item_lists.splice(index, 1)
    },
    deleteCropImg: function(index){
      this.inputData.img_lists.splice(index, 1)
    },
     addSupport: function(){
    	let todo = {support_item: this.support_item, delete: 'X'};
        
      this.inputData.support_item_lists.push(todo );
      this.support_item = '';
    },
    deleteSupport: function(index){
      this.inputData.support_item_lists.splice(index, 1)
    },
                /*add delete review and support*/

            changeImg() {
                this.option.img = this.lists[~~(Math.random() * this.lists.length)].img
            },
            startCrop() {
                // start
                this.crap = true
                this.$refs.cropper.startCrop()
            },
            stopCrop() {
                //  stop
                this.crap = false
                this.$refs.cropper.stopCrop()
            },
            clearCrop() {
                // clear
                this.$refs.cropper.clearCrop()
            },
            refreshCrop() {
                // clear
                this.$refs.cropper.refresh()
            },
            changeScale(num) {
                num = num || 1
                this.$refs.cropper.changeScale(num)
            },
            rotateLeft() {
                this.$refs.cropper.rotateLeft()
            },
            rotateRight() {
                this.$refs.cropper.rotateRight()
            },
            finish(type) {
                // 输出
                // var test = window.open('about:blank')
                // test.document.body.innerHTML = '图片生成中..'
                if (type === 'blob') {
                    this.$refs.cropper.getCropBlob((data) => {
                        console.log(data);
                        var img = window.URL.createObjectURL(data)
                        this.model = true
                        this.modelSrc = img
                    })
                } else {
                    this.$refs.cropper.getCropData((data) => {
                        this.model = true
                        this.modelSrc = data
                    })
                }
            },
            addmoreImg(type) {
                this.canvas_view = false;
                // 输出
                // var test = window.open('about:blank')
                // test.document.body.innerHTML = '图片生成中..'
                if (type === 'blob') {
                    this.$refs.cropper.getCropBlob((data) => {
                         console.log(data);
                        var img = window.URL.createObjectURL(data)
                        // console.log(img);
                        this.inputData.img_lists.push({
                            img: img
                        });
                    })
                } else {
                    this.$refs.cropper.getCropData((data) => {
                        // this.modelSrc = data
                        
                        this.inputData.img_lists.push({
                            img: data
                        });
                    })
                }
                console.log(this.inputData.img_lists);
                this.clearCrop();
            },
            // 实时预览函数
            realTime(data) {
                this.previews = data
                console.log(data)
            },

            finish2(type) {
                this.$refs.cropper2.getCropData((data) => {
                    this.model = true
                    this.modelSrc = data
                })
            },
            finish3(type) {
                this.$refs.cropper3.getCropData((data) => {
                    this.model = true
                    this.modelSrc = data
                })
            },
            down(type) {
                // event.preventDefault()
                var aLink = document.createElement('a')
                aLink.download = 'demo'
                // 输出
                if (type === 'blob') {
                    this.$refs.cropper.getCropBlob((data) => {
                        this.downImg = window.URL.createObjectURL(data)
                        aLink.href = window.URL.createObjectURL(data)
                        aLink.click()
                    })
                } else {
                    this.$refs.cropper.getCropData((data) => {
                        this.downImg = data
                        aLink.href = data
                        aLink.click()
                    })
                }
            },

            uploadImg(e, num) {
                //上传图片
                // this.option.img
                this.canvas_view = true;
                var file = e.target.files[0]
                if (!/\.(gif|jpg|jpeg|png|bmp|GIF|JPG|PNG)$/.test(e.target.value)) {
                    alert('图片类型必须是.gif,jpeg,jpg,png,bmp中的一种')
                    return false
                }
                var reader = new FileReader()
                reader.onload = (e) => {
                    let data
                    if (typeof e.target.result === 'object') {
                        // 把Array Buffer转化为blob 如果是base64不需要
                        data = window.URL.createObjectURL(new Blob([e.target.result]))
                    } else {
                        data = e.target.result
                    }
                    if (num === 1) {
                        this.option.img = data
                    } else if (num === 2) {
                        this.example2.img = data
                    }
                }
                // 转化为base64
                // reader.readAsDataURL(file)
                // 转化为blob
                reader.readAsArrayBuffer(file)
            },
            imgLoad(msg) {
                console.log(msg)
            },
            cropMoving(data) {
                console.log(data, '截图框当前坐标')
            },
            //get Table data
            /*
            loadProductData() {
              axios.get(this.BASE_URL+"api/get_all_products")
                .then(({ data }) => {
                    this.product_list_arr = data.products;
                })
                .catch(() => {
                  console.log("Error...");
                });
            },
            */

 //get contact list
            loadContactData() {
                axios.get(this.BASE_URL + "api/get_all_contact_list?client_id="+Globals.user_info_client_id)
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.contact_list = data.contact_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });
            },

            //getcategory
            loadProductCategoryData() {
                axios.get(this.BASE_URL + "api/get_all_product_category?client_id="+Globals.user_info_client_id)
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.category_list = data.category_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });
            },
            //getbrand
            loadProductBrandData() {
                axios.get(this.BASE_URL + "api/get_all_product_brand")
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.brand_list = data.brand_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });
            },
            //getmanufacturer
            loadProductManufacturerData() {
                axios.get(this.BASE_URL + "api/get_all_product_manufacturer")
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.manufacturer_list = data.manufacturer_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });
            },
            showsubcatlist(data) {
                console.log(data);
                this.selected_sub_product_categorie_id = '';
                this.loadProductSubCategoryData(data.product_categorie_id);
            },
            //getcategory
            loadProductSubCategoryData(category_id) {
                axios.get(this.BASE_URL + "api/get_all_product_sub_category/" + category_id)
                    .then(({
                        data
                    }) => {
                        console.log(data);
                        this.sub_category_list = data.sub_category_list;
                    })
                    .catch(() => {
                        console.log("Error...");
                    });
            },
    reset() {
    Object.assign(this.$data,  this.$options.data.apply(this))
},
            //product attr
            addNewproductattr: function (index) {
                this.inputData.multipleitem.product_attributes.push(Vue.util.extend({}, this.product_attribute))
            },
            removeproductattr: function (index) {
                Vue.delete(this.inputData.multipleitem.product_attributes, index);
            },
            //product attr
            //product add update
            productAddUpdate(){
            //   console.log(this.inputData);
            //   return false;
            this.$v.inputData.$touch();
      if(this.$v.inputData.$error) return
            let formData = new FormData();
            this.inputData.client_id = Globals.user_info_client_id;
    formData.append('all_inputdata', this.inputData);
     let config = { headers: { 'Content-Type': 'application/json' } }
              axios.post(this.BASE_URL+'/api/add_product_to_db',  this.inputData,
             config)
                .then((res) => {
                     //Perform Success Action
                     console.log(res);
                     if(res.data.result==200){
                         Swal.fire({
                icon: 'success',
                title: 'Product',
                text: res.data.message
            })

this.reset();
this.loadContactData();
            this.loadProductCategoryData();

            
                     }else{
                         console.log(res.data);
                         Swal.fire({
                icon: res.data.class_name,
                title: res.data.title,
                text: res.data.message
            })
                     }
                 })
                 .catch((error) => {
                     console.log(error);
                     // error.response.status Check status code
                 }).finally(() => {
                     //Perform action in always
                 });
            }
        },
validations: {
    inputData: {
      product_name: { required, min: minLength(3) },
     
      singleitem:{
          item_code: { required:requiredIf(function(inputData){
            
            if(this.inputData.selected_item_type=='0'){
                return true;
            }
        }) },
          cost_price: { required:requiredIf(function(inputData){
            
            if(this.inputData.selected_item_type=='0'){
                return true;
            }
        }) },
          wholesale_price: { required:requiredIf(function(inputData){
            
            if(this.inputData.selected_item_type=='0'){
                return true;
            }
        }) },
          retail_price: { required:requiredIf(function(inputData){
            
            if(this.inputData.selected_item_type=='0'){
                return true;
            }
        }) },
        
        },
       
        multipleitem:{
            item_code: { required:requiredIf(function(inputData){
            if(this.inputData.selected_item_type=='1'){
                return true;
            }
        }) },

            product_attributes:{
              $each:{  
                color: {
                    
                     required:requiredIf(function(inputData){
                    
                    if(this.inputData.selected_item_type=='1'){
                        return true;
                    }
                }) 
                
                },
                size: {
                    
                     required:requiredIf(function(inputData){
                    
                    if(this.inputData.selected_item_type=='1'){
                        return true;
                    }
                }) 
                
                },
                cost_price: {
                    
                     required:requiredIf(function(inputData){
                    
                    if(this.inputData.selected_item_type=='1'){
                        return true;
                    }
                }) 
                
                },
                wholesale_price: {
                    
                     required:requiredIf(function(inputData){
                    
                    if(this.inputData.selected_item_type=='1'){
                        return true;
                    }
                }) 
                
                },
                retail_price: {
                    
                     required:requiredIf(function(inputData){
                    
                    if(this.inputData.selected_item_type=='1'){
                        return true;
                    }
                }) 
                
                },
               
    }
            }
        },
        // selected_sub_product_categorie_id: { required },
        selected_product_categorie_id: { required },
        contact_id: { required },
        // selected_manufacture_id: { required },
        // selected_brand_id: { required },
    }
  },
        created() {
            console.log(this.$route.params.product_type);
            this.inputData.product_type = this.$route.params.product_type;
            this.inputData.adm_user_id = this.global_user_id;
          console.log(this.inputData.multipleitem.product_attributes);
          this.inputData.user_id=Globals.user_info_id;
                    this.inputData.client_id=Globals.user_info_client_id;
            //LoadTableData
            // this.loadProductData();
            this.loadContactData();
            this.loadProductCategoryData();
            this.loadProductBrandData();
            this.loadProductManufacturerData();
            //this.loadProductSubCategoryData();
            // this.loadProductbrandData();
            // this.loadProductManufacturerData();
        },
        computed: {
            
        },
        mounted() {
            console.log("product add page loaded");
        }
    };

</script>
