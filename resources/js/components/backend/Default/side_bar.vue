<template>
  <!-- Main Sidebar -->
  <!-- main-sidebar -->
  <aside class="main-sidebar" style="position: absolute; top: -60px;width:100%">
    <div class="main-navbar">
      <nav class="navbar navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <router-link to="/home" class="nav-link" style="line-height: 25px;margin:0 auto;">
            <img v-if="user_data.image!=null && user_data.image!=''"
              id="main-logo"
              class="d-inline-block align-top mr-1"
              style="width: 56px"
              :src="BASE_URL + '/public/backend/images/logo/'+user_data.image"
              alt="inventory"
            />
         
            <img v-else
              id="main-logo"
              class="d-inline-block align-top mr-1"
              style="width: 56px"
              :src="BASE_URL + '/public/backend/images/logo/warehouse-inventory-icon-6.png'"
              alt="inventory"
            />
        </router-link>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
          <i class="material-icons">&#xE5C4;</i>
        </a>
      </nav>
    </div>
    <div class="nav-wrapper">
      <ul class="nav flex-column">
        <!-- <li class="nav-item text-center" v-can="['dashboard_menu']">
          
          <a
            class="nav-link collapsed"
            href="#dashboardmenu1"
            data-toggle="collapse"
            data-target="#dashboardmenu1"
            >
             <b-icon icon="truck" font-scale="2.2"></b-icon><br>
            Admin</a
          >
          <div class="collapse" id="dashboardmenu1" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
              <li class="nav-item" v-can="['dashboard_menu']">
                <router-link to="/home" class="nav-link">
                  {{ myLang.dashboard_text }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['dashboard_menu']">
                <router-link to="/home" class="nav-link">
                 Reports
                </router-link>
              </li>
              <li class="nav-item" v-can="['dashboard_menu']">
                <router-link to="/home" class="nav-link">
                  Settings
                </router-link>
              </li>
              <li class="nav-item" v-can="['role_menu']">
                <router-link to="/role" class="nav-link">
                  
                  {{ myLang.role_management }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['permission_menu']">
                <router-link to="/permission" class="nav-link">
                  
                  {{ myLang.permission_management }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['assign_role_to_user_menu']">
                <router-link to="/assign_role_to_user" class="nav-link">
                 
                  {{ myLang.assign_role_to_user }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['assign_permission_to_user_menu']">
                <router-link to="/assign_permission_to_user" class="nav-link">
                 
                  {{ myLang.assign_permission_to_user }}
                </router-link>
              </li>
              <li class="nav-item" v-can="['manage_user_menu']">
                <router-link to="/users" class="nav-link">
                  
                  {{ myLang.manage_users }}
                </router-link>
              </li>
              
            </ul>
          </div>
        </li> -->
        
          <!--Contacts-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#productsListdata" data-toggle="collapse" data-target="#productsListdata">
           <b-icon icon="truck" font-scale="2.2"></b-icon><br>
           Products</a>
          <div class="collapse" id="productsListdata" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/product_lists" class="nav-link">
                  Product
                </router-link>
              </li>
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/pcategory" class="nav-link">
                  Product Category
                </router-link>
              </li> 
            </ul>
          </div>
        </li>
         <!--Sales-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#Purchase" data-toggle="collapse" data-target="#Purchase">
            <b-icon icon="truck" font-scale="2.2"></b-icon><br>
           Purchase</a>
          <div class="collapse" id="Purchase" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
               <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/purchase" class="nav-link">
                  Purchase list
                </router-link>
              </li> 
            </ul>
          </div>
        </li>
        <!--Sales-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#sales" data-toggle="collapse" data-target="#sales">
            <b-icon icon="truck" font-scale="2.2"></b-icon><br>
           Sales</a>
          <div class="collapse" id="sales" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/sell" class="nav-link">
                  Sales
                </router-link>
              </li> 
              
            </ul>
          </div>
        </li>

       

        <!--Contacts-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#paymentReceive" data-toggle="collapse" data-target="#paymentReceive">
           <b-icon icon="truck" font-scale="2.2"></b-icon><br>
           Payments/Receive</a>
          <div class="collapse" id="paymentReceive" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
             <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/payments" class="nav-link">
                  Payments/Receive
                </router-link>
              </li>
            </ul>
          </div>
        </li>

      

        <!--Contacts-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#costList" data-toggle="collapse" data-target="#costList">
           <b-icon icon="truck" font-scale="2.2"></b-icon><br>
           Daily Cost</a>
          <div class="collapse" id="costList" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
             
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/cost" class="nav-link">
                  Cost
                </router-link>
              </li> 
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/category" class="nav-link">
                  Cost Category
                </router-link>
              </li> 
            </ul>
          </div>
        </li>


        <!--procurement-->
        <li class="nav-item text-center" v-can="['Admin_view']">
          <a class="nav-link collapsed" href="#procurement" data-toggle="collapse" data-target="#procurement"> 
            <b-icon icon="truck" font-scale="2.2"></b-icon><br>
          Reports</a>
          <div class="collapse" id="procurement" aria-expanded="false">
            <ul class="flex-column text-left pl-2 nav">
               
               <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/stocks" class="nav-link">
                  Stocks
                </router-link>
              </li>
               <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/myblance" class="nav-link">
                  Balance Sheet
                </router-link>
              </li>
               <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/mydues" class="nav-link">
                  Stores Due
                </router-link>
              </li> 
              <li class="nav-item" v-can="['Admin_view']">
                <router-link to="/customerdues" class="nav-link">
                  Customer Due
                </router-link>
              </li> 
            </ul>
          </div>
        </li> 
      </ul>
    </div>
  </aside>
</template>

<script>
export default {
  name: "sidebar",
  props: ["app"],
  data() {
    return {
        user_data:null,
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
    };
  },
  methods: {
    logout: function () {
      axios
        .post("logout")
        .then((response) => {
          if (response.status === 302 || 401) {
            console.log("logout");
          } else {
            // throw error and go to catch block
          }
        })
        .catch((error) => {});
    },
  },
  created(){
    this.user_data=this.app._data;
}
};
</script>