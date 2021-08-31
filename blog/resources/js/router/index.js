import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../pages/blog/HomePage'
import LoginView from '../pages/auth/Login'
import RegisterView from "../pages/auth/Register";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: HomeView,
        meta: {
            title: 'Home',
            requireAuth:true
        }
    },
    {
        path: '/login',
        name: 'Login',
        component: LoginView
    },
    {
        path: '/register',
        name: 'Register',
        component: RegisterView
    },
    // {
    //     path: '/country-city',
    //     name: 'CountryCity',
    //     component: CountryCity,
    //     meta: {
    //         title: 'Country-city',
    //         requireAuth:true
    //     }
    //
    // },
]

const router = new VueRouter({
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return {x: 0, y: 0}
    },
    routes
})

export default router
