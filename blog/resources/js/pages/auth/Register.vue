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
            <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
        <div>
            <router-link to="/login" class="nav-link mt-3">Already have an Account. </router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
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
            let url = '/api/register'
            let formdata = new FormData()
            formdata.set('name',this.name)
            formdata.set('email',this.email)
            formdata.set('password',this.password)
            formdata.set('confirm_password',this.confirm_password)
            axios.post(url,formdata).then(
                res=>{
                    if(res.data==='complete') this.$router.push('/')
                    else alert(`${res.data.message}`)
                }
            ).catch(err=>console.log(err))
        }
    }
}
</script>
