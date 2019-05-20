<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                  <div class="card-tools">
                      
                  </div>
                   <div id="printMe"> 
                       
                    <div class="center">               
                      
                      <img src="../../../../../public/AA_Logo.png" v-bind:style="{ marginLeft: '200px', width: '165px', height: '160px',float:'left' }">
                      <h1 class="headline">ATMA AUTO</h1>
                      <p class="hehe" >
                      MOTORCYCLE SPAREPARTS AND SERVICES<br>
                      Jl. Babarsari No. 43 Yogyakarta 552181<br>
                      Telp. (0274)487711<br>
                      http://www.atmaauto.com
                      </p>
                      
                      <hr>
                      <br>
                      <p class="title">LAPORAN SPAREPART TERLARIS</p>                                       
                    </div> 
                    <div class="card-body table-responsive p-0">
                    
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th class="No-Row">No</th>
                        <th>Bulan</th>
                        <th>Nama Barang</th>
                        <th>Tipe Barang</th>
                        <th>Jumlah Penjualan</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(sparepart,index) in filteredList" :key ="sparepart.id">
                        <td>{{ index+1 }}</td>
                        <td>{{ sparepart.bullan }}</td>
                        <td>{{ sparepart.nama }}</td>
                        <td>{{ sparepart.tipe }}</td>
                        <td>{{ sparepart.jumlah_penjualan }}</td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                  </div> 
                    
                    <br>
                    <div align="center">
                      <button class="button is-success" @click="print">Cetak</button>
                    </div>
                </div>     
            </div>
        </div>
    </div>
</div>
</template>


<script>
  export default {
    data: function() {
      return {
        sparepart: {},
        loading: true,
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    computed: {
       filteredList: function(){
         return this.sparepart;
       }
    },
    methods: {
      getResults(){
        var app = this;
        axios.get('/api/report/spare_terlaris')
        .then(function(resp){
        app.sparepart = resp.data;
        app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      },
      print() {
        this.$htmlToPaper('printMe');
      },
    }
  }
</script>