<template>
    <div class="container-fluid">
        <NavBar />
        <router-view />
    </div>
</template>

<script>
import NavBar from "./components/NavBar";
export default {
    name:"main-view",
    components:{
        NavBar
    }
}
</script>
