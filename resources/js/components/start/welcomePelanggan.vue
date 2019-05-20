<template>
    <div class="container">
   
                <div class="center">               
                      
                      <img src="../../../../public/AA_Logo.png" v-bind:style="{ marginLeft: '200px', width: '165px', height: '160px',float:'left' }">
                      <h1 class="headline">ATMA AUTO</h1>
                      <p class="hehe" >
                      MOTORCYCLE SPAREPARTS AND SERVICES<br>
                      Jl. Babarsari No. 43 Yogyakarta 552181<br>
                      Telp. (0274)487711<br>
                      http://www.atmaauto.com
                      </p>
                      
                      <hr>                                 
                </div> 

            <hooper :settings="hooperSettings" :progress="true" :autoPlay="true" :playSpeed="2000">
                <slide>
                    <img src="../../../../public/honda-logo.jpg">
                </slide>
                <slide>
                    <img src="../../../../public/Yamaha-logo.jpg">
                </slide>
                <slide>
                    <img src="../../../../public/yokohama-logo.png">
                </slide>
            </hooper>
     
</div>
     
</template>

<script>
  import { Hooper, Slide } from 'hooper';

  export default {
    name: 'App',
    components: {
      Hooper,
      Slide
    },
    data () {
      return {
        hooperSettings: {
          //itemsToShow: 1,
          centerMode: true
        }
      }
    }
  }
</script>