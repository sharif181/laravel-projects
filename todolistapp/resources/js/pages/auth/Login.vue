<template>
    <div class="container mt-5">
        <form @submit.prevent= "submit_form" >
            <div class="form-group">
                <label >Email address</label>
                <input v-model= "email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label >Password</label>
                <input v-model= "password" type="password" class="form-control" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div>
            <router-link class="btn btn-secondary mt-4" to="/register"> sign up</router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import NotificationService from '../../service/notification.service'
export default {
    name:"LoginView",
    data(){
        return{
            email:"",
            password:"",
        }
    },
    methods:{
        submit_form:function(){
            if(this.email.length>0 && this.password.length>0){
                let url = '/login'
                let form = new FormData()
                form.set('email',this.email)
                form.set('password',this.password)
                axios.post(url,form)
                .then(res=>{
                    if(res.data){
                        NotificationService.success("Login successfully")
                        localStorage.setItem('accessToken',res.data)
                        this.$router.push('/')
                    }else{
                        NotificationService.error("Wrong Credential!!!")
                    }
                }).catch(error=>console.log(error))
            }else{
                NotificationService.info('Email and password required!!!')
            }
        }
    }
}
</script>
