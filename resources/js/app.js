
import VueRouter from 'vue-router';
import Vuetify from 'vuetify';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css';


require('./bootstrap');

window.Vue = require('vue');


Vue.component('app-component', require('./components/AppComponent.vue').default);

Vue.use(Vuetify);
Vue.use(VueRouter);
const router = new VueRouter({
    routes: [
        {
            path: '/goal',
            name: 'goal',
            component: () => import('./components/goal/Goal.vue'),
        },
        {
            path: '/goalcreate',
            name: 'goalcreate',
            component: () => import('./components/goal/Goalcreate.vue'),
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
        {
            path: '/calendar',
            name: 'calendar',
            component: () => import('./components/calendar/Calendar.vue'),
        },
    ]
});

const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
});






// routes: [
//     {
//         path: '/preview',
//         children:[
//             {
//               path: '/',
//               component: () => import('./components/molecules/PreviewList.vue'),
//             },
//             {
//               path: 'list',
//               component: () => import('./components/molecules/PreviewList.vue'),
//         ]
//     }
//   ]