import {isEmpty} from "lodash";

require('./bootstrap');

window.Vue = require('vue').default;

import router from "./router/index";
import apiClient from './service/apiClient'
import Swal from 'sweetalert2'
window.Swal = require('sweetalert2');
//Toast
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.$with_bearer_token = apiClient;

Vue.component('main-view', require('./MainView').default);
router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.requireAuth)) {
        if (!localStorage.getItem('accessToken')) {
            next({
                name: 'Login',
                // params: {nextUrl: to.fullPath}
            })
        } else {
            $with_bearer_token.get('/api/profile').then(response => {
                console.log(isEmpty(response.data))
                if(isEmpty(response.data) !== true)
                    next()
                else{
                    localStorage.removeItem('accessToken')
                    next({name: 'Login'})
                }
            }).catch(error => {
                localStorage.removeItem('accessToken')
                next({name: 'Login'})
            })
            // next();
        }
    }
    next();
})

const app = new Vue({
    el: '#app',
    router
});
