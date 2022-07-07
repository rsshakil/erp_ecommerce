<template>
<div class="main-content-container container-fluid px-0">
    <form class="form" @submit.prevent="processData()">
    <div class="page-header row no-gutters py-4">
        <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
            <h3 class="page-title"> Merchant </h3>
        </div>
    </div>
    <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">{{ cardTitle }} </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="offset-md-1 col-md-10 ">
                            <div class="card card-primary">
                                  <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-6" v-if="isEdit==false">
                                                <label for="merchant_name">Name <span style="font-weight: bold; color: red;">*</span></label>
                                                <input type="text" v-model="inputData.merchant_name" name="merchant_name" id="merchant_name" class="form-control" placeholder="Merchant Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="company_name">Company Name <span style="font-weight: bold; color: red;">*</span></label>
                                                <input type="text" name="company_name" v-model="inputData.company_name" id="company_name" class="form-control" placeholder="Company Name">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="full_address">Full Address <span style="font-weight: bold; color: red;">*</span></label>
                                                <textarea name="full_address" v-model="inputData.full_address" id="full_address" class="form-control" placeholder="Merchant Address"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="business_address">Business Address</label>
                                                <textarea name="business_address" v-model="inputData.business_address" id="business_address" class="form-control" placeholder="Business Address"></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="district_id"> Districts <span style="font-weight: bold; color: red;">*</span></label>
                                                    <!--:close-on-select="true"
                                                    <v-select v-model="inputData.district_id" :options="districts" :reduce="district=>district.district_id" placeholder="Please select district" label="district_name" @input="getThanas_act"></v-select>-->
                                                    <multiselect v-model="inputData.district_ids" :options="districts" :searchable="true" :close-on-select="true" :show-labels="false" return="district_id" placeholder="Please select district" label="district_name" track-by="district_id" @select="getThanas($event)"></multiselect>

                                                    <input type="hidden" name="district_id" v-model="inputData.district_id">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="upazila_id"> Thana/Upazila <span style="font-weight: bold; color: red;">*</span> </label>
                                                <!--    <v-select v-model="inputData.thana_id" :options="thanas" :reduce="thana=>thana.thana_id" placeholder="Please select thana" label="thana_name" @select="getAreas($event)"></v-select>-->
                                                    <multiselect v-model="inputData.thana_ids" :options="thanas" :searchable="true" :close-on-select="true" :show-labels="false" placeholder="Please select thana" label="thana_name" return="thana_id" track-by="thana_id" @select="getAreas($event)"></multiselect>

                                                    <input type="hidden" name="thana_id" v-model="inputData.thana_id">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="area_id"> Area <span style="font-weight: bold; color: red;">*</span> </label>
                                                  <!-- <v-select v-model="inputData.area_id" :options="areas"  :reduce="area=>area.area_id"  placeholder="Please select thana" label="area_name" @select="setArea($event)"></v-select>-->
                                                   <multiselect v-model="inputData.area_ids" :options="areas" :searchable="true" :close-on-select="true" :show-labels="false" placeholder="Please select thana" label="area_name" return="area_id" track-by="area_id" @select="setArea($event)"></multiselect>

                                                    <input type="hidden" name="area_id" v-model="inputData.area_id">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone"> Contact Number <span style="font-weight: bold; color: red;">*</span> </label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                    <div class="input-group-text">+88</div>
                                                    </div>
                                                    <input type="text" name="phone" v-model="inputData.phone" id="phone" value="" class="form-control" placeholder="Merchant Contact Number" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="facebook">Facebook</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                      <div class="input-group-text">http://</div>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="inputData.facebook" id="facebook" name="facebook" value="" placeholder="Merchant Facebook Url">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="website">Website</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                      <div class="input-group-text">http://</div>
                                                    </div>
                                                    <input type="text" class="form-control" v-model="inputData.website" id="website" name="website" placeholder="Merchant Website Url">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                    <label for="image">Image </label>
                                                    <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="image" id="image" @change="previewImage">
                                                        <label class="custom-file-label" for="image">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img :src="imageData" width="100px">
                                                    
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6"  v-if="isEdit==false">
                                                <label for="email">Email <span style="font-weight: bold; color: red;">*</span> </label>
                                                <input type="email" name="email" v-model="inputData.email" id="email" class="form-control" placeholder="Email" >
                                            </div>

                                            <div class="col-md-6"  v-if="isEdit==false">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" v-model="inputData.password" id="password"  class="form-control" placeholder="Password">
                                            </div>
                                            <div class="col-md-12 row" style="margin-top: 20px;">
                                                <div class="col-md-12" style="border-bottom: 2px #000 dotted ">
                                                    <label for="charge"> Bank Informations</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="bank_name">Bank Name</label>
                                                    <input type="text" v-model="inputData.bank_name" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="account_holder_name">Account Holder Name</label>
                                                    <input type="text" v-model="inputData.account_holder_name" name="account_holder_name" id="account_holder_name" class="form-control" placeholder="Bank Account Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="account_number">Bank Account Number</label>
                                                    <input type="text" v-model="inputData.account_number" id="account_number" name="account_number" class="form-control" placeholder="Bank Account Number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="bkash_number">BKash Number</label>
                                                    <input type="text" v-model="inputData.bkash_number" id="bkash_number" name="bkash_number" class="form-control" placeholder="BKash Number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nagad_number">Nagad Number</label>
                                                    <input type="text" v-model="inputData.nagad_number" id="nagad_number" name="nagad_number" class="form-control" placeholder="Nagad Number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="rocket_number">Rocket Number</label>
                                                    <input type="text" v-model="inputData.rocket_number" name="rocket_number" id="rocket_number" class="form-control" placeholder="Rocket Number">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="nid_card"> NID Card  </label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="nid" id="nid_card">
                                                            <label class="custom-file-label" for="nid_card">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="trade_license">Trade License  </label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="trade_license" id="trade_license">
                                                            <label class="custom-file-label" for="trade_license">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="tin_certificate">TIN Certificate </label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="tin" id="tin_certificate">
                                                            <label class="custom-file-label" for="tin_certificate">Choose file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <!--<button type="submit" class="btn btn-success" @click="addMerchant()">Submit</button>
                                            <button type="reset" class="btn btn-primary" @click="resetMerchantForm()">Reset</button>-->

                                        </div>
                                                      <div class="card-footer">
                           <FormButton :isEdit="isEdit" :backUrl="backUrl"></FormButton>
                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
  </form>
</div>
</template>
<script>
import mixin from '../../Mixin/mixin';
export default {
    mixins:[mixin],
  data() {
    return {
    form:{
        // merchant_id:null,
        // name:null, //merchant_name
        // company_name:null,
        // phone:null,
        // email:null,
        // password:null,
        // image:null,
        // full_address:null,
        // business_address:null,
        // district:null,
        // thana:null,
        // area:null,
        // facebook:null,
        // website:null,
        // bank_name:null,
        // account_holder_name:null,
        // account_number:null,
        // bkash_number:null,
        // nagad_number:null,
        // rocket_number:null,
        // nid:null,
        // trade_license:null,
        // tin:null,
    }
    };
  },
  methods: {
        // getThanas_act() {
        //     alert(inputData.district_id);
        //     console.log(inputData.district_id);
        // },
    // addMerchant(){
    //     // console.log(this.form)
    //     // return 0;
    //     this.loaderrrsss = Vue.$loading.show();
    //     var merchent_url="add_merchant";
    //     if (this.form.merchant_id!=null) {
    //         merchent_url="update_merchant";
    //     }
    //     axios.post(merchent_url, this.form)
    //       .then(({ data }) => {
    //         this.alert_icon=data.class_name;
    //         this.alert_title=data.title;
    //         this.alert_text= data.message;
    //         this.sweet_normal_alert()
    //         this.loaderrrsss.hide();
    //     });
    // },
    // resetMerchantForm(){
    //     Object.assign(this.$data, this.$options.data.apply(this))
    //     this.getDistricts();
    //     this.$router.push({name:'add_merchant'}).catch(()=>{});
    // },

    // getSingleMerchant(merchant_id){
    //     axios.post("get_single_merchant", {merchant_id:merchant_id})
    //       .then(({ data }) => {
    //           console.log(data)
    //           this.form=data.merchant
    //           this.thanas=this.form.thanas
    //           this.areas=this.form.areas
    //         // this.alert_icon=data.class_name;
    //         // this.alert_title=data.title;
    //         // this.alert_text= data.message;
    //         // this.sweet_normal_alert()
    //         // this.loaderrrsss.hide();
    //     });
    // }
  },
  created() {

            this.generalApi = 'merchants'
            this.backUrl = '/merchants'
            this.isFile = true
            this.isImage = 'image_path',
            this.cardTitle = this.isEdit ? 'Edit Marchant' : 'Add Marchant'
            this.getDistricts();

        },
  mounted() {

    //   this.form.merchant_id=this.$route.query.merchant_id
    //   console.log(this.form.merchant_id)
    //   console.log("Hi")
    // if (this.form.merchant_id) {
    //     this.getSingleMerchant(this.form.merchant_id)
    // }
  }
};
</script>
