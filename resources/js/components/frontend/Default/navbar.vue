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
            <ul class="navbar-nav border-left flex-row ">
                <li class="nav-item">
                <a href="login" class="nav-link">
                  <b-icon icon="house-fill" font-scale="1.2"></b-icon> Login
                </a>
              </li>
              <li class="nav-item">
                <router-link to="/ask-a-demo" class="nav-link">
                  <b-icon icon="person-check-fill" font-scale="1.2"></b-icon>
                  Ask a Demo
                </router-link>
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
}
}
</script>