// import Home from './pages/Home'
// import Register from './pages/Register'
// import Login from '../Login/login_body.vue'
const Login = () =>
    import ( /* webpackChunkName: "backend/Login" */ '../Login/login_body.vue')
    // import Login from './components/backend/Login/login_body.vue'
    // import Dashboard from './pages/user/Dashboard'
    // import AdminDashboard from './pages/admin/Dashboard'
const Home = () =>
    import ( /* webpackChunkName: "backend/Home" */ '../Admin/home_component.vue')
const Role = () =>
    import ( /* webpackChunkName: "backend/Role" */ '../Admin/role_component.vue')
const permission = () =>
    import ( /* webpackChunkName: "backend/permission" */ '../Admin/permission_component.vue')
const assign_role_model = () =>
    import ( /* webpackChunkName: "backend/assign_role_model" */ '../Admin/assign_role_model.vue')
const assign_permission_model = () =>
    import ( /* webpackChunkName: "backend/assign_permission_model" */ '../Admin/assign_permission_model.vue')
const users = () =>
    import ( /* webpackChunkName: "backend/users" */ '../Admin/users.vue')
const user_update = () =>
    import ( /* webpackChunkName: "backend/user_update" */ '../Admin/user_update.vue')
const password_reset = () =>
    import ( /* webpackChunkName: "backend/password_reset" */ '../Admin/password_reset.vue')
const add_merchant = () =>
    import ( /* webpackChunkName: "backend/add_merchant" */ '../components/MERCHANT/add_merchant.vue')
const all_merchants = () =>
    import ( /* webpackChunkName: "backend/all_merchants" */ '../components/MERCHANT/all_merchants.vue')
const all_shops = () =>
    import ( /* webpackChunkName: "backend/all_shops" */ '../components/MERCHANT/all_shops.vue')
const add_parcel = () =>
    import ( /* webpackChunkName: "backend/add_parcel" */ '../components/PARCEL/add_parcel.vue')
const pending_parcels = () =>
    import ( /* webpackChunkName: "backend/pending_parcels" */ '../components/PARCEL/pending_parcels.vue')
const all_parcels = () =>
    import ( /* webpackChunkName: "backend/all_parcels" */ '../components/PARCEL/all_parcels.vue')
    // Application settings
const charge_list = () =>
    import ( /* webpackChunkName: "backend/charge_list" */ '../components/APPLICATION/charge_list.vue')
const weight_list = () =>
    import ( /* webpackChunkName: "backend/weight_list" */ '../components/APPLICATION/weight_list.vue')
const charge_packages = () =>
    import ( /* webpackChunkName: "backend/charge_packages" */ '../components/APPLICATION/charge_packages.vue')
const delivery_options = () =>
    import ( /* webpackChunkName: "backend/delivery_options" */ '../components/APPLICATION/delivery_options.vue')

const add_hub = () =>
    import ( /* webpackChunkName: "backend/add_hub" */ '../components/HUB/add_hub.vue')
const hub_index = () =>
    import ( /* webpackChunkName: "backend/hub_index" */ '../components/HUB/hub_index.vue')

const addHubUser = () =>
    import ( /* webpackChunkName: "backend/addHubUser" */ '../components/HUB_USER/add.vue')
const hubUsers = () =>
    import ( /* webpackChunkName: "backend/hubUsers" */ '../components/HUB_USER/index.vue')

export const routes = [{
        path: '/login',
        name: 'admin_login',
        component: Login,
        meta: {
            auth: false
        }
    },
    { path: '/', redirect: { name: 'admin_login' } },
    {
        path: '/dashboard',
        name: 'admin_home',
        component: Home,
        meta: {
            auth: true
        }
    },
    { path: '/role', name: 'role', component: Role },
    { path: '/permission', name: 'permission', component: permission },
    { path: '/assign_role_to_user', name: 'assign_role_to_user', component: assign_role_model },
    { path: '/assign_permission_to_user', name: 'assign_permission_to_user', component: assign_permission_model },
    { path: '/users', name: 'users', component: users },
    { path: '/users/user_update', name: 'user_update', component: user_update },
    { path: '/users/password_reset', name: 'password_reset', component: password_reset },
    { path: '/merchants', name: 'merchants', component: all_merchants },
    { path: '/merchants/create', name: 'add-merchant', component: add_merchant },
    { path: '/merchants/:id', name: 'edit-merchant', component: add_merchant },
    { path: '/all_shops', name: 'all_shops', component: all_shops },
    { path: '/add_parcel', name: 'add_parcel', component: add_parcel },
    { path: '/all_parcels', name: 'all_parcels', component: all_parcels },
    { path: '/charge_list', name: 'charge_list', component: charge_list },
    { path: '/weight_list', name: 'weight_list', component: weight_list },
    { path: '/charge_packages', name: 'charge_packages', component: charge_packages },
    { path: '/delivery_options', name: 'delivery_options', component: delivery_options },
    { path: '/hubs', name: 'hubs', component: hub_index },
    { path: '/hubs/create', name: 'add-hubs', component: add_hub },
    { path: '/hubs/:id', name: 'edit-hubs', component: add_hub },
    { path: '/hub-users', name: 'hub_users', component: hubUsers },
    { path: '/hub-users/create', name: 'add_hub_user', component: addHubUser },
    { path: '/hub-users/:id', name: 'edit_hub_user', component: addHubUser },


];