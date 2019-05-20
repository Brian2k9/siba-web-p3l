<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Konfirmasi Pengiriman Pengadaan Sparepart</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to = "/trans_pengadaan" class="button is-warning"> <i class="fas fa-arrow-left"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari status sedang dikirim" v-bind:style="{width: '25%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th class="id-row">ID</th>
                        <th>Supplier</th>
                        <th>Cabang</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Total Harga Pengadaan</th>
                        <th>Status Pengadaan</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(trans_pengadaan,index) in filteredList" :key ="trans_pengadaan.id">
                        <td>{{ trans_pengadaan.id }}</td>
                        <td>{{ trans_pengadaan.supplier.nama_supplier }}</td>
                        <td>{{ trans_pengadaan.cabang.nama_cabang }}</td>
                        <td>{{ trans_pengadaan.tanggal_pengadaan }}</td>
                        <td>{{ trans_pengadaan.total_harga_pengadaan }}</td>
                        <td>{{ trans_pengadaan.status_pengadaan }}</td>
                        <td>
                        <router-link 
                          :to="{name:'konfirmasiPengiriman' ,params:{id: trans_pengadaan.id}}" 
                          class="button is-warning">
                          <i class="fas fa-box"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(trans_pengadaan.id,index)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                   </div>     
                    <div class="card-footer">
                      <pagination class="card-footer-item"
                        :data="trans_pengadaanData" @pagination-change-page="getResults" :limit="4">
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
        transaksiPengadaan: [],
        trans_pengadaanData: {},
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
         return this.transaksiPengadaan.filter((trans_pengadaan) => {
           return trans_pengadaan.status_pengadaan.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/trans_pengadaan?page=' + page)
        .then(function(resp){
          app.transaksiPengadaan = resp.data.data;
          app.trans_pengadaanData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      
      deleteEntry(id,index){
          axios.delete('/api/trans_pengadaan/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Transaksi Pengadaan ");
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Transaksi Pengadaan")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Transaksi Pengadaan ?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index);
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