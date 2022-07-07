/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
// import vueselect from 'vue-select2';
//Routes
import { routes } from './routes_front';
//Import Sweetalert2
import Swal from 'sweetalert2'
//Import v-from
import { Form, HasError, AlertError } from 'vform';
//Import vue multi select
import Multiselect from 'vue-multiselect';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import FlagIcon from 'vue-flag-icon'


Vue.use(VueRouter);

// Install BootstrapVue
Vue.use(BootstrapVue)
    //     // Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
    // Vue.use(FlagIcon);
    // register globally
Vue.component('multiselect', Multiselect)
    // Vue.use(vueselect);
    //Pagination laravel-vue-pagination
Vue.component('pagination', require('laravel-vue-pagination'));
// spinner register 
Vue.component('spinner', require('vue-simple-spinner'));

window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError);
// define a mixin object for global function
import myMixin from './myMixin_frontend'
Vue.mixin(myMixin)

// Permission check directive 
Vue.directive('can', function(el, binding, vnode) {
    var given_permission = binding.value;
    if (typeof given_permission == 'string') {
        given_permission = [given_permission]
    }
    if (given_permission) {
        var true_array = [];
        var false_array = [];
        for (let i = 0; i < given_permission.length; i++) {
            if (Permissions.indexOf(given_permission[i]) !== -1) {
                true_array.push(true);
            } else {
                false_array.push(false);
            }

        }
        if (true_array.length) {
            return vnode.elm.hidden = false;
        } else {
            return vnode.elm.hidden = true;
        }
    }
});
var router = new VueRouter({
    routes: routes,
    linkActiveClass: "active", // active class for non-exact links.
    linkExactActiveClass: "active", // active class for *exact* links.
    mode: 'history',
    base: '/geniecup'
});
import App from './components/frontend/Default/app.vue'
new Vue({
    router: router,
    render: h => h(App)
}).$mount("#app");