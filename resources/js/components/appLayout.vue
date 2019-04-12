<template>
<div class="bg">
<router-view></router-view>
</div>
</template>

<script>
    export default{
        mounted(){
            console.log('component mounted')
        }
    }
</script>

<style>
    .bg{
        background-color:silver;
        height: 100vh;
    }
</style>
