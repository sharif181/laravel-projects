<template>
   <div class="container mt-5">
       <div class="card">
           <div class="card-header">
               Country-City<span><router-link class="btn btn-warning ml-2" to="/">Back to Todolist</router-link></span>
           </div>
           <div class="card-body">
               <table class="table table-bordered">
                   <tr>
                       <th scope="col">Country</th>
                       <th scope="col">City</th>
                   </tr>
                   <tr v-for="(country,index) in this.countries" :key="index">
                       <td>
                           {{ country.country_name }}
                       </td>
                       <td>
                           <span v-for="(city,ind) in country.cities" :key="ind" >
                               {{city.city_name}},
                           </span>
                       </td>
                   </tr>
               </table>
           </div>
       </div>
   </div>
</template>

<script>

export  default {
    name:'CountryCity',
    data(){
        return{
            countries:[]
        }
    },
    mounted() {
        let url = '/country-city-list'
        $with_bearer_token.get(url).
        then(res=>{
            this.countries = res.data
        }).
        catch(error=>console.log(error.message))
    }
}
</script>
