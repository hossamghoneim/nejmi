require('./bootstrap');
import Vue from 'vue'
import routes from "./router/index"


Vue.component('app', require('./components/App').default);


const app = new Vue({
    el: '#app',
    router: routes,
});
