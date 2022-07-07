import index_page from './components/frontend/pages/index_page.vue'
import askAdemo from './components/frontend/pages/askAdemo.vue'

export const routes = [
    { path: '/', component: index_page },
    { path: '/ask-a-demo', component: askAdemo },
];