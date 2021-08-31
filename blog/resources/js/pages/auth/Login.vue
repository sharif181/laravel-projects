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
            <button type="submit" class="btn btn-primary mt-2">Login</button>
        </form>
        <div>
            <router-link class="nav-link mt-4" to="/register"> Don't have account? </router-link>
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
            let url = '/api/login'
            let formdata = new FormData()
            formdata.set('email',this.email)
            formdata.set('password',this.password)
            axios.post(url,formdata).then(
                res=>{
                    if(res.data){
                        NotificationService.success("Login successfully")
                        localStorage.setItem('accessToken',res.data)
                        this.$router.push('/')
                    }else{
                        NotificationService.error("Wrong Credential!!!")
                    }
                }
            ).catch(error=>console.log(error))
        }
    }
}
</script>
