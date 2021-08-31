<template>
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <router-link to="/country-city" class="btn btn-success ml-3"> Go to Country-City </router-link>
            <button @click="logout" class="btn btn-danger ml-3"> Logout </button>
        </div>
        <div class="mt-2">
            <input v-on:keyup = "search_task" v-model= "search_text" name='search' type="text" placeholder="Search task">
        </div>
        <div class="justify-content-between mt-2">
            <h5 class="display-5">Todo list app</h5>
        </div>
        <input  v-model= "task_text" name='task' type="text" class="form-control" placeholder="Add task..">
        <button v-on:click = "save_todo" type="submit" class="btn btn-primary mt-2">Save</button>
        <div class="card mt-2" v-for="todo in todos" :key="todo.id">
            <div class="card-body justify-content-between">
                <p>{{todo.task}} </p>
                <button v-on:click = "edit_task(todo.id,todo.task)" class="btn btn-secondary m-2" :id="todo.id" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> Edit</button>
                <button v-on:click = "delete_task(todo.id,todo.task)" class="btn btn-danger" :id="todo.id" data-toggle="modal" data-target="#exampleModal"> Delete</button>
            </div>
        </div>
    </div>
</template>

<script>
import NotificationService from '../../service/notification.service'
export default {
    name:'Mainview',
    data(){
        return{
            todos: [],
            isEdit:false,
            task_text : "",
            search_text : "",
            task: "",
            todo: ""
        }
    },
    mounted(){
        this.getValue()
    },

    methods:{
        async delete_task(id,task){
            Swal.fire({
                title: `Do you want to delete ${task}?`,
                showDenyButton: true,
                confirmButtonText: `Delete`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $with_bearer_token.get('todo/'+id)
                    .then(
                        NotificationService.success("Successfully Delete task")
                    )
                    this.getValue()
                    Swal.fire('Deleted!', '', 'success')
                }
            })
        },
        save_todo:function(){
            if(this.task_text.length>0){
                const todo = {task:this.task_text}
                let url = '/create-todo'
                $with_bearer_token.post(url,todo)
                .then(
                    res=> {
                        this.todos.unshift(res.data)
                        NotificationService.success('Task has been saved')
                    }
                )
                this.task_text = ""
                this.search_text = ""
            }else{
                NotificationService.task_add_warning("Please add task.")
            }
        },
        search_task:function(){
            if(this.search_text.length==0) this.getValue()
            else{
                let url = '/search/'+this.search_text;
                $with_bearer_token.get(url)
                .then(res=>this.todos=res.data)
            }
        },

        async toggleButton(val){
            this.isEdit = val
        },
        async edit_task(id,task){
            await Swal.fire({
                title: 'Edit Task',
                input: 'text',
                inputLabel: `Do you want to edit ${task}`,
                inputValue: task,
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to write something!'
                    }else{
                        let url = '/update/'+id
                        let todo = {
                                id:id,
                                task:value
                            }
                        $with_bearer_token.put(url,todo)
                        .then(
                            NotificationService.success("Successfully edit task")
                        )
                        this.getValue()
                    }
                }
            })
        },
        async getValue(){
            let url = '/todos'
            $with_bearer_token.get(url)
            .then(res => {
                this.todos = res.data
            })
        },
        logout(){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    NotificationService.success('Logout')
                    localStorage.removeItem('accessToken');
                    this.$router.push('/login')
                }
            })

        }
    },

}
</script>
