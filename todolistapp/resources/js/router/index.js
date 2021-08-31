import Vue from 'vue'
import VueRouter from 'vue-router'
import Mainview from '../pages/todolist/Master.vue'
import LoginView from '../pages/auth/Login.vue'
import RegisterView from '../pages/auth/Register.vue'
import CountryCity from "../pages/country-city/CountryCity";

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Mainview,
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
    {
        path: '/country-city',
        name: 'CountryCity',
        component: CountryCity,
        meta: {
            title: 'Country-city',
            requireAuth:true
        }

    },
]

const router = new VueRouter({
  // mode: 'history',
  // base: process.env.BASE_URL,
    mode: 'history',
    base: '/',
    scrollBehavior() {
        return {x: 0, y: 0}
    },
  routes
})

export default router
