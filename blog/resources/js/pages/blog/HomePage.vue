<template>
    <div>

        <div class="container mt-5">
            <div class="d-flex justify-content-between m-3">
                <button class="btn btn-primary">Add Blog</button>
                <input type="text" placeholder="Search blog">
            </div>
            <div class="bg-light mt-5 row">
                <div v-for="(blog, index) in blogs"  :key="index" class="col-6">
                    <div class="card m-5" style="width: 18rem;">
<!--                        <img src="./public/" class="card-img-top" alt="...">-->
                        <div class="card-body">
                            <h5 class="card-title">{{blog.title}}</h5>
                            <p class="card-text">{{blog.subtitle}}</p>
                            <button @click="blog_details(blog.id)" class="btn btn-info">Details</button>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <li v-if="this.links.prev" class="page-item"><router-link class="page-link" :to=`${{this.links.prev}}`>Previous</router-link></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li v-if="this.links.next" class="page-item"> <router-link class="page-link" :to="${{this.links.next}}">Next</router-link></li>
                </ul>
            </nav>
        </div>


    </div>
</template>

<script>
export default {
    name:"HomeView",
    data(){
        return{
            blogs:[],
            links:{}
        }
    },
    mounted() {
        $with_bearer_token.get('/api/blogs').then(
            res=>{
                this.blogs = res.data.data
                this.links = res.data.links
                console.log(this.links)
            }
        ).catch(error=>console.log(error.message))
    },
    methods:{
        blog_details(id){
            $with_bearer_token.get(`/api/blogs/${id}`).then(
                res=>console.log(res.data)
            )
        }
    }
}
</script>
