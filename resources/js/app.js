/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)



Vue.component('example-component', require('./components/ExampleComponent.vue').default);



let sidebar = require('./components/Sidebar.vue').default;
let addComponent = require('./components/AddStudent.vue').default;
let viewComponent = require('./components/ViewStudents.vue').default;
let createComponent = require('./components/CreateComponent.vue').default;
let editComponent = require('./components/EditStudent.vue').default;
let createPostComponent = require('./components/CreatePost.vue').default;

Vue.component('pagination', require('laravel-vue-pagination'));
const routes = [
    { path: '/VueStudent/addStudents', component: addComponent },
    { path: '/VueStudent/', component: createComponent },
  { path: '/VueStudent/viewStudents', component: viewComponent },
  { path: '/VueStudent/editStudent/:id', component: editComponent },
  { path: '/VueStudent/createPost', component: createPostComponent }
]
const router = new VueRouter({
    mode:'history',
  routes // short for `routes: routes`
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    components:{sidebar},
    router,
    data:{
        message:''
    },
    methods:{

    }
});
