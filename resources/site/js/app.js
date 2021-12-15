require('./bootstrap');
import Vue from "vue";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
Vue.component('booking', require('./components/booking').default);
const app = new Vue({
    el: '#app',
});
