<template>
    <div class="container mt-5">
        <form @submit.prevent= "submit_form" >
            <div class="form-group">
                <label >Name</label>
                <input v-model= "name" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label >Email address</label>
                <input v-model= "email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label >Password</label>
                <input v-model= "password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <label >Confirm Password</label>
                <input v-model= "confirm_password" type="password" class="form-control" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div>
            <router-link to="/login" class="btn btn-secondary mt-3">Sign in</router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import NotificationService from '../../service/notification.service'
export default {
    name:"RegisterView",
    data(){
        return{
            name:"",
            email:"",
            password:"",
            confirm_password:""
        }
    },
    methods:{
        submit_form:function(){
            if(this.name.length>0 && this.email.length>0 && this.password.length>0 && this.confirm_password.length>0){
                let url = '/register'
                let form = new FormData()
                form.set('name',this.name)
                form.set('email',this.email)
                form.set('password',this.password)
                form.set('c_password',this.confirm_password)
                axios.post(url,form).then(res=>{
                    if(res.data==='complete'){
                        NotificationService.success("Registration completed")
                        this.$router.push('/login')
                    }else{
                        NotificationService.error(res.data.message)
                    }
                }).catch(err=>{
                    NotificationService.error(err.message)
                })
            }else{
                NotificationService.info('Please provide all information')
            }
        }
    }
}
</script>
