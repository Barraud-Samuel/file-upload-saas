require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import store from './store'

import App from './App.vue';
import VueRouter from 'vue-router';
import {routes} from './router.js';
import middlewarePipeline from './middlewarePipeline'
import axios from "axios";



Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

axios.defaults.baseURL = process.env.MIX_VUE_APP_BASE_URL_API || 'http://127.0.0.1:8000/'
axios.defaults.withCredentials = true

router.beforeEach((to,from,next)=>{
    if (!to.meta.middleware){
        return next()
    }

    const middleware = to.meta.middleware

    const context = {
        to,
        from,
        store,
        next
    }

    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    })
})

const app = new Vue({
    el: '#app',
    store,
    router: router,
    render: h => h(App),
});
