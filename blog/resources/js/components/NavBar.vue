<template>
    <ul class="nav justify-content-end bg-light fixed-top">
        <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
        </li>
        <li class="nav-item">
            <router-link v-if="!isLogin" class="nav-link" to="/login">Login</router-link>
        </li>
        <li class="nav-item">
            <router-link v-if="!isLogin" class="nav-link" to="/register">Register</router-link>
        </li>
        <li class="nav-item">
            <button v-if="isLogin" class="btn-danger" @click="logout">Logout</button>
        </li>
    </ul>
</template>

<script>
import NotificationService from "../service/notification.service";
export default {
    name:'NavBar',
    data(){
        return{
            isLogin:false
        }
    },
    mounted() {
        if(localStorage.getItem('accessToken')){
            this.isLogin= true
        }
    },
    methods:{
        logout(){
            localStorage.removeItem('accessToken')
            NotificationService.error('Successfully Logout !!!!')
            this.router.push('/')
        }
    }
}
</script>
