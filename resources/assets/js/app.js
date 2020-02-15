
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './app.vue'
import VueRouter from 'vue-router';
//import iView from 'iview';
//import 'iview/dist/styles/iview.css';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.use(iView);
Vue.use(ViewUI);
Vue.use(VueRouter);
const RouterConfig = {
    routes: [
        // ExampleComponent laravel默认的示例组件
        { path: '/', component: require('./components/ExampleComponent.vue') },
        { path: '/up',name:'up',component: require('./components/up.vue')},   
        { path: '/admin',name:'admin',component: require('./components/admin.vue')},
        { path: '/mission/:did',name:'mission',component: require('./components/mission.vue')},
        { path: '/adminlist',name:'adminlist',component: require('./components/adminlist.vue')}
    ]
};

const router = new VueRouter(RouterConfig);

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});