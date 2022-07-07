/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
const options_css = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=yes',
      'scrollbars=yes'
    ],
    styles: [
      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
      'https://unpkg.com/kidlat-css/css/kidlat.css',
      './print.css'
    ]
  };
window.Vue = require('vue');
import VueRouter from 'vue-router';
// import vueselect from 'vue-select2';
//Routes
import { routes } from './routes';
//Import Sweetalert2
import Swal from 'sweetalert2'
//Import v-from
import { Form, HasError, AlertError } from 'vform';
//Import vue multi select
import Multiselect from 'vue-multiselect';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// import FlagIcon from 'vue-flag-icon'

import VModal from 'vue-js-modal'
import Toasted from 'vue-toasted';
import VuejsDialog from 'vuejs-dialog';
import VuejsDialogMixin from 'vuejs-dialog/dist/vuejs-dialog-mixin.min.js'; // only needed in custom components

// include the default style
import 'vuejs-dialog/dist/vuejs-dialog.min.css';
Vue.use(VModal)
Vue.use(Toasted)
Vue.use(VuejsDialog)
Vue.use(VuejsDialogMixin)

import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', vSelect)
import VueHtmlToPaper from 'vue-html-to-paper';
Vue.use(VueHtmlToPaper,options_css);


// Excell
import JsonExcel from "vue-json-excel";
Vue.component("downloadExcel", JsonExcel);

import VueFlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
Vue.use(VueFlatPickr);

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
Vue.component('TableContent', require('./components/Default/TableContent').default);
Vue.component('FormButton', require('./components/Default/FormButton').default);
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
import myMixin from './myMixin'
Vue.mixin(myMixin)
//ckeedit
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use( CKEditor );
//ckeedit
//image crop
import VueCropper from 'vue-cropper' 

Vue.use(VueCropper)

import Vuelidate from "vuelidate";
Vue.use(Vuelidate);

//  import VueLazyload from 'vue-lazyload'
// Vue.use(VueLazyload)
//image crop
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
        // if (true_array.length) {
        //     return vnode.elm.hidden = false;
        // } else {
        //     return vnode.elm.hidden = true;
        // }
    }
});
// Role check directive
Vue.directive("role", function(el, binding, vnode) {
    var given_role = binding.value;
    if (typeof given_role == "string") {
        given_role = [given_role];
    }
    if (given_role) {
        var true_array = [];
        var false_array = [];
        for (let i = 0; i < given_role.length; i++) {
            if (Roles.indexOf(given_role[i]) !== -1) {
                true_array.push(true);
            } else {
                false_array.push(false);
            }
        }
        if (true_array.length) {
            return (vnode.elm.hidden = false);
        } else {
            return (vnode.elm.hidden = true);
        }
    }
});
var router = new VueRouter({
    routes: routes,
    linkActiveClass: "active", // active class for non-exact links.
    linkExactActiveClass: "active", // active class for *exact* links.
    mode: 'history',
    base: '/geniecup/admin'
});
import App from './components/backend/Default/app.vue'
new Vue({
    router: router,
    render: h => h(App)
}).$mount("#app");