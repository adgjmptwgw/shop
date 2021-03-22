/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// -------------------------------------------
// Vueインストール時に追記(Vue2->Vue3は下記の追記が必要)
import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'
import FavoriteComponent from './components/FavoriteComponent.vue'
import BaseCheckbox from './components/BaseCheckbox.vue'

createApp({
    components:{
        ExampleComponent,
        FavoriteComponent,
        BaseCheckbox,
    }
}).mount('#app')
// -------------------------------------------

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

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('favorite-component', require('./components/FavoriteComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
