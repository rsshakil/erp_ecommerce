<template>
<main class="main-content p-0 ">
    <div class="main-navbar sticky-top bg-white">
        <!-- Main Navbar -->
        <nav class="navbar align-items-stretch navbar-light flex-md-nowrap p-0">
            <form action="#" class="main-navbar__search w-100 d-none d-md-flex d-lg-flex">
                <div class="input-group input-group-seamless ml-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                        </div>
                    </div>
                    <input class="navbar-search form-control" type="hidden" placeholder="Search for something..."
                        aria-label="Search">
                </div>
            </form>
            <ul class="navbar-nav flex-row ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="productList" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="productList">
                         <router-link to="/product_lists" class="dropdown-item">
                  Product list
                </router-link>
                 <router-link to="/pcategory" class="dropdown-item">
                  Product Category
                </router-link>
                    </div>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="Purchase" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Purchase</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="Purchase">
                            <router-link to="/purchase" class="dropdown-item">
                             Purchase list
                            </router-link>
                    </div>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="Sales" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sales</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="Sales">
                            <router-link to="/sell" class="dropdown-item">
                             Sales list
                            </router-link>
                    </div>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="payments" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Payments/Receive</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="payments">
                            <router-link to="/payments" class="dropdown-item">
                             Payments/Receive list
                            </router-link>
                    </div>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="cost" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cost</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="cost">
                            <router-link to="/cost" class="dropdown-item">
                             Cost list
                            </router-link>
                            <router-link to="/category" class="dropdown-item">
                             Cost Category list
                            </router-link>
                    </div>
                </li>   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="Reports" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports</a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="Reports">
                            <router-link to="/stocks" class="dropdown-item">Stocks list</router-link>
                            <router-link to="/myblance" class="dropdown-item">Balance sheet</router-link>
                            <router-link to="/mydues" class="dropdown-item">Stores Due</router-link>
                            <router-link to="/customerdues" class="dropdown-item">Customer Due</router-link>
                           
                    </div>
                </li>   
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="flag-icon flag-icon-bd" v-if="local=='bn'" ></span> 
                            <span class="flag-icon flag-icon-us" v-if="local=='en'"></span> {{local=='en'?'English':'বাংলা'}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" :href="BASE_URL+'/language/en'"><span
                                class="flag-icon flag-icon-us"></span> English</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" :href="BASE_URL+'/language/bn'"><span
                                class="flag-icon flag-icon-bd"></span> বাংলা</a>
                    </div>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-nowrap px-3" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle mr-2" style="max-height: 46px !important;" v-if="user_data.user" :src="imageSrc(user_data.user.image)" alt="">
                        <!-- <div v-else><b-icon icon="trash-fill" font-scale="1.2"></b-icon></div> -->
                        <span class="d-none d-md-inline-block">{{(user_data.user)?user_data.user.name:''}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-small" style="margin-left: -60px;">
                        <!-- <router-link :to="{ name: 'users', params: { id: global_user_id,auth_id:global_user_id } }" class="dropdown-item"><b-icon icon="person" font-scale="1.2"></b-icon> {{myLang.profile_text}}</router-link>
                        <router-link :to="{ name: 'password_reset', params: { id: global_user_id,auth_id:global_user_id  } }" class="dropdown-item pc"><b-icon icon="pencil-square" font-scale="1.2"></b-icon> {{myLang.change_password}}</router-link>
                        <div class="dropdown-divider"></div> -->
                        <button class="dropdown-item text-danger" @click="logout()"> <b-icon icon="box-arrow-right" font-scale="1.2"></b-icon> Logout </button>
                    </div>
                </li>
            </ul>
            <nav class="nav">
                <a href="#" class="nav-link nav-link-icon toggle-sidebar d-md-inline d-lg-none text-center border-left"
                    data-toggle="collapse" data-target=".header-navbar" aria-expanded="false"
                    aria-controls="header-navbar">
                    <i class="material-icons">&#xE5D2;</i>
                </a>
            </nav>
        </nav>
    </div>
    <!-- / .main-navbar -->
</main>
</template>

<script>
export default {
name: 'navbar',
props:['app'],
data(){
    return {
        local:Globals.local,
        user_data:null,
        // BASE_URL:BASE_URL,
    }
},
methods:{
},
created(){
    this.user_data=this.app._data;
}
}
</script>