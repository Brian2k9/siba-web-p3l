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
        height: auto;
    }

    .card-tools{
    margin-top: 10px;
    }
    th{
        background-color: darkgray;
    }
    .card{
        padding: 18px 30px 15px 30px;
    }
    .footer{
        background-color: black;
        height: auto;
    }
    .fade-enter,
    .fade-leave-to {
    opacity: 0;
    transform: rotateY(50deg);
    }
    .fade-enter-to,
    .fade-leave {
    opacity: 1;
    transform: rotateY(0deg);
    }
    .fade-enter-active,
    .fade-leave-active {
    transition: opacity, transform 200ms ease-out;
    }
</style>
