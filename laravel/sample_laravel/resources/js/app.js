/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 //Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 
 import axios from 'axios';
 import VueAxios from 'vue-axios';
 import VueRouter from 'vue-router';
 import { routes } from './routes';
 import Echo from 'laravel-echo';
 Vue.use(VueRouter);
 Vue.use(VueAxios, axios);
 window.Pusher = require('pusher-js');
 window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'app-key',
    wsHost: '127.0.0.1',
    wsPort: '6001',
    //wssPort: process.env.MIX_PUSHER_PORT,
    forceTLS: false,
    encrypted: false,
    disableStats: true,
    enabledTransports: ['ws'],
 });

 const router = new VueRouter({
     mode: 'history',
     routes: routes
 });

//  console.log(process.env.MIX_PUSHER_APP_KEY);
//  console.log(process.env.MIX_PUSHER_APP_CLUSTER);

 // Component files
 import App from './App'

 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
     router: router,
     render: h => h(App),
 });