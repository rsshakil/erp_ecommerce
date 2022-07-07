import Home from './components/backend/Admin/home_component.vue'
import Role from './components/backend/Admin/role_component.vue'
import permission from './components/backend/Admin/permission_component.vue'
import assign_role_model from './components/backend/Admin/assign_role_model.vue'
import assign_permission_model from './components/backend/Admin/assign_permission_model.vue'
import users from './components/backend/Admin/users.vue'
import user_update from './components/backend/Admin/user_update.vue'
import password_reset from './components/backend/Admin/password_reset.vue'
import product_lists from './components/backend/product/product_list.vue'
import add_product from './components/backend/product/add_product.vue'
import purchase from './components/backend/purchase/add.vue'
import edit_purchase from './components/backend/purchase/edit.vue'
import edit_purchase_return from './components/backend/purchase/edit_return.vue'
import all_purchase_list from './components/backend/purchase/all_purchase_list.vue'
//sell
import sell_add from './components/backend/sell/add.vue'
import sell_edit from './components/backend/sell/edit.vue'
import sell_return from './components/backend/sell_return/edit.vue'
import sell_index from './components/backend/sell/index.vue'
import stocks_index from './components/backend/product/index.vue'
import category_add from './components/backend/category/Create.vue'
import category_index from './components/backend/category/Index.vue'
import pcategory_add from './components/backend/pcategory/Create.vue'
import pcategory_index from './components/backend/pcategory/Index.vue'
import cost_add from './components/backend/cost/Create.vue'
import cost_index from './components/backend/cost/Index.vue'

import mydues_add from './components/backend/mydues/Create.vue'
import mydues_index from './components/backend/mydues/Index.vue'

import customerdues_add from './components/backend/customerdues/Create.vue'
import customerdues_index from './components/backend/customerdues/Index.vue'
import myblance_index from './components/backend/customerdues/Index.vue'


import payments_add from './components/backend/payments/Create.vue'
import payments_index from './components/backend/payments/Index.vue'

// import login_body from './components/login/login_body.vue'

export const routes = [
    { path: '/admin', name:'home', component: Home },
    { path: '/home', name:'home', component: Home },
    { path: '/role',name:'role', component: Role },
    { path: '/permission',name:'permission', component: permission },
    { path: '/assign_role_to_user',name:'assign_role_to_user', component: assign_role_model },
    { path: '/assign_permission_to_user',name:'assign_permission_to_user', component: assign_permission_model },
    { path: '/users',name:'users', component: users },
    { path: '/users/:id/:auth_id', name: 'user_update', component: user_update },
    { path: '/password_reset/:id/:auth_id', name: 'password_reset', component: password_reset },
    { path: '/purchase', name: 'purchase-list', component: all_purchase_list},
    { path: '/purchase/create', name: 'add-purchase', component: purchase },
    { path: '/purchase/:id', name: 'edit-purchase', component: edit_purchase },
    { path: '/purchasereturn/:id', name: 'return-purchase', component: edit_purchase_return },
    { path: '/product_lists', name: 'product_lists', component: product_lists },
    { path: '/add_product/:product_type', name: 'add_product', component: add_product },

    { path: '/sell', name: 'sell-list', component: sell_index},
    { path: '/sell/create', name: 'add-sell', component: sell_add },
    { path: '/sell/:id', name: 'edit-sell', component: sell_edit },
    { path: '/returnsell/:id', name: 'return-sell', component: sell_return },
    { path: '/stocks', name: 'stocks-list', component: stocks_index},

    { path: '/category', name: 'category-list', component: category_index},
    { path: '/category/create', name: 'add-category', component: category_add },
    { path: '/category/:id', name: 'edit-category', component: category_add },

    { path: '/pcategory', name: 'pcategory-list', component: pcategory_index},
    { path: '/pcategory/create', name: 'add-pcategory', component: pcategory_add },
    { path: '/pcategory/:id', name: 'edit-pcategory', component: pcategory_add },

    { path: '/cost', name: 'cost-list', component: cost_index},
    { path: '/cost/create', name: 'add-cost', component: cost_add },
    { path: '/cost/:id', name: 'edit-cost', component: cost_add },

    { path: '/mydues', name: 'mydues-list', component: mydues_index},
    { path: '/mydues/create', name: 'add-mydues', component: mydues_add },
    { path: '/mydues/:id', name: 'edit-mydues', component: mydues_add },

    { path: '/customerdues', name: 'customerdues-list', component: customerdues_index},
    { path: '/customerdues/create', name: 'add-customerdues', component: customerdues_add },
    { path: '/customerdues/:id', name: 'edit-customerdues', component: customerdues_add },
    { path: '/myblance', name: 'myblance-list', component: myblance_index},

    
    { path: '/payments', name: 'payments-list', component: payments_index},
    { path: '/payments/create', name: 'add-payments', component: payments_add },
    { path: '/payments/:id', name: 'edit-payments', component: payments_add },

];