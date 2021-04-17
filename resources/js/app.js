
import VueRouter from 'vue-router';
require('./bootstrap');

window.Vue = require('vue');


Vue.component('app-component', require('./components/AppComponent.vue').default);

Vue.use(VueRouter);
const router = new VueRouter({
    routes: [
        {
            path: '/task',
            name: 'task',
            component: () => import('./components/task/Task.vue'),
        },
        {
            path: '/search',
            name: 'search',
            component: () => import('./components/search/Search.vue'),
        },
        {
            path: '/user',
            name: 'user',
            component: () => import('./components/user/User.vue'),
        },
    ]
});

const app = new Vue({
    el: '#app',
    router
});
