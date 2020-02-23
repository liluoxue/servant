
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './app.vue'
import VueRouter from 'vue-router';
import Vuex from 'vuex';
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
Vue.use(Vuex);
const RouterConfig = {
    routes: [
        // ExampleComponent laravel默认的示例组件
        { path: '/', meta:{isLogin: false},component: require('./components/ExampleComponent.vue') },
        { path: '/up',meta:{isLogin: false},name:'up',component: require('./components/up.vue')},   
        { path: '/admin',meta:{isLogin: true},name:'admin',component: require('./components/admin.vue')},
        { path: '/mission/:did',name:'mission',meta:{isLogin: false},component: require('./components/mission.vue')},
        { path: '/adminlist',name:'adminlist',meta:{isLogin: true},component: require('./components/adminlist.vue')}
    ]
};

const store = new Vuex.Store({
    state:{
        isLogin:false,
    },
    getter:{
        isLogin:state=>state.isLogin,
    },
    mutations:{
        userStatus(state,flag){
            state.isLogin=flag
        }
    },
    actions:{
        userLogin({commit},flag){
            commit("userStatus",flag);
        }
    }
});

const router = new VueRouter(RouterConfig);

router.beforeEach((to,from,next)=>{
    let getFlag = localStorage.getItem("Flag");
    if(getFlag==="isLogin")
    {
        store.state.isLogin = true;
        next();

    }
    else{
        //console.log(to.meta.isLogin);
        //console.log(to);
        if(to.meta.isLogin){
            //next({path:'/',});
            //console.log(this.Message);
            ViewUI.Message.info('请登陆哟');
        }
        else
        next();
    }

});

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});