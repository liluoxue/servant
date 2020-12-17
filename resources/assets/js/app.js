
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
import App from './app.vue'
import axios from 'axios';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
//import iView from 'iview';
//import 'iview/dist/styles/iview.css';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import storageData from'./storageData';

Vue.prototype.$axios = axios;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
//Vue.use(iView);
Vue.use(ViewUI);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.prototype.storageData = storageData;
const RouterConfig = {
    routes: [
        // ExampleComponent laravel默认的示例组件
        { path: '/', meta:{isLogin: false,isAdmin:false},component: require('./components/ExampleComponent.vue') },
        { path: '/up',meta:{isLogin: true,isAdmin:false},name:'up',component: require('./components/up.vue')},   
        { path: '/admin',meta:{isLogin: true,isAdmin:true},name:'admin',component: require('./components/admin/admin.vue')},
        { path: '/dorm/:did',name:'mission',meta:{isLogin: true,isAdmin:false},component: require('./components/dorm.vue')},
        { path: '/adminlist',name:'adminlist',meta:{isLogin: true,isAdmin:true},component: require('./components/admin/adminlist.vue')},
        { path: '/admindorm',name:'admindorm',meta:{isLogin: true,isAdmin:true},component: require('./components/admin/admindorm.vue')}
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
    
    if(axios.defaults.headers.common['Authorization']!='' && typeof(axios.defaults.headers.common['Authorization'])!="undefined")
    {
        store.state.isLogin = true;
        if(to.meta.isAdmin){
            //console.log(storageData.isAdmin);
            if(storageData.isAdmin==false){
                ViewUI.Message.info('此模块为管理员模块');
            }
            else{
                next();
            }
        }
        else
        {next();}

    }
    else{
        //console.log(to.meta.isLogin);
        //console.log(to);
        if(to.meta.isLogin){
            //next({path:'/',});
            //console.log(this.Message);
             ViewUI.Message.info('请登录哟');
        }
        else
        next();
    }

});
axios.interceptors.response.use(function (response) {
    console.log(response);
  return response;
}, (err)=>{
console.log(err);
  if (err && err.response) {
      switch (err.response.status) {
          case 400:
              ViewUI.Message.error( '请求错误(400)');
              break;
          case 401:
              ViewUI.Message.error( '未授权，请重新登录(401)');
              break;
          case 403:
              ViewUI.Message.error( '拒绝访问');
              break;
          case 404:
              ViewUI.Message.error( '请求的地址不存在');
              break;
          case 408:
              ViewUI.Message.error( '请求超时(408)');
              break;
          case 422:
              ViewUI.Message.error( '提交的数据不正确');
              break;
          case 429:
              ViewUI.Message.error( '请求过于频繁，系统拒绝响应');
              break;
          case 500:
              ViewUI.Message.error( '服务器错误');
              break;
          case 501:
              ViewUI.Message.error( '服务未实现(501)');
              break;
          case 502:
              ViewUI.Message.error( '网络错误(502)');
              break;
          case 503:
              ViewUI.Message.error( '服务不可用(503)');
              break;
          case 504:
              ViewUI.Message.error( '网络超时(504)');
              break;
          case 505:
              ViewUI.Message.error( 'HTTP版本不受支持(505)');
              break;
          default:
              ViewUI.Message.error( '连接出错(${err.response.status})!');
      }
  } else {
    ViewUI.Message.error( '连接服务器失败!')
  }
  //this.$toastr.w(err.message);
  return Promise.reject(err);
});
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
});