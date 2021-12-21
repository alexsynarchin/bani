require('./bootstrap');
import Vue from "vue";
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
import lang from 'element-ui/lib/locale/lang/ru-RU'
import locale from 'element-ui/lib/locale'
locale.use(lang);
import VueDataTables from 'vue-data-tables';
Vue.use(VueDataTables);

Vue.component('LoginForm', require('./components/login/Form.vue').default);
Vue.component('OrdersList', require('./components/orders/index').default);
Vue.component('PlacesDashboard',require('./components/places-dashboard/index').default);

const app = new Vue({
    el: '#app',
    data: {
        isLoading: true,

    },   created(){

        this.loadedApp();
    },
    methods:{
        async loadedApp(){
            this.isLoading = false;
        },
    }
});
