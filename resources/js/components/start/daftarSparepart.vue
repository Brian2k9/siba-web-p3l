<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    
                  </div>
                  <div class="card-tools">
                      
                  </div>

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
                      <br>
                      <p class="title">DAFTAR SPAREPART</p>                                       
                    </div> 
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        
                        <th>Nama Sparepart</th>
                        <th>Merk Sparepart</th>
                        <th>Tipe Sparepart</th>
                        <th>Gambar Sparepart</th>
                        <th>Jumlah Stok Sparepart</th>
                        <th>Harga Jual Sparepart</th>
                        
                        
                        
                    </thead>
                    <tbody>
                      <tr v-for="(sparepart,index) in filteredList" :key ="sparepart.id">
                        
                        <td>{{ sparepart.nama_sparepart }}</td>
                        <td>{{ sparepart.merk_sparepart }}</td>
                        <td>{{ sparepart.tipe_sparepart }}</td>
                        <td><img :src="'/images/sparepart/' + sparepart.gambar_sparepart" v-bind:style="{width: '100px', height: '100px' }"></td>
                        <td>{{ sparepart.jumlah_stok_sparepart }}</td>
                        
                        <td>{{ sparepart.harga_jual_sparepart }}</td>
                       
                       
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                   </div>     
                    <div class="card-footer">
                      <pagination class="card-footer-item"
                        :data="sparepartsData" @pagination-change-page="getResults" :limit="4">
                        <span slot="prev-nav">&lt; Previous</span>
	                      <span slot="next-nav">Next &gt;</span>
                      </pagination>
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
        spareparts: [],
        sparepartsData: {},
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    computed: {
       filteredList: function(){
         return this.spareparts.filter((sparepart) => {
           return sparepart.nama_sparepart.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/sparepart?page=' + page)
        .then(function(resp){
          app.spareparts = resp.data.data;
          app.sparepartsData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getHasilPencarian(page){
          
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/spaarepart/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.spareparts = resp.data.data;
          app.sparepartsData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaSparepart){
          axios.delete('/api/sparepart/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Sparepart " + namaSparepart);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Sparepart")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaSparepart){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Sparepart " + namaSparepart + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaSparepart);
          }
        })  
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      }
    }
  }

</script>
