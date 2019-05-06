<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Daftar Transaksi Service</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_trans_jasa" class="button is-success">Tambah Transaksi Service &nbsp; <i class="fas fa-plus-circle"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama service" v-bind:style="{width: '25%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th>Nomor Transaksi Penjualan</th>
                        <th>Jasa Service</th>
                        <th>Pegawai</th>
                        <th>Kendaraan</th>
                        <th>Jumlah Jasa</th>
                        <th>Total Harga Jasa</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(transaksi,index) in filteredList" :key ="transaksi.id">
                        <td>{{ transaksi.id_trans_penjualan }}</td>
                        <td>{{ transaksi.jasa_service.nama_jasa }}</td>
                        <td>{{ transaksi.pegawai.nama_pegawai }}</td>
                        <td>{{ transaksi.kendaraan.tipe_kendaraan }}</td>
                        <td>{{ transaksi.jumlah_jasa }}</td>
                        <td>{{ transaksi.total_harga_jasa }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editDetailTransJasa' ,params:{id: transaksi.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(transaksi.id,index,transaksi.id_trans_penjualan)">
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
                        :data="detailTransJasaData" @pagination-change-page="getResults" :limit="4">
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
        detailTransJasa: [],
        detailTransJasaData: {},
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
         return this.detailTransJasa.filter((transaksi) => {
           return transaksi.jasa_service.nama_jasa.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/trans_penjualan/detail_jasa?page=' + page)
        .then(function(resp){
          app.detailTransJasa = resp.data.data;
          app.detailTransJasaData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      
      deleteEntry(id,index,noTransPenjualan){
          axios.delete('/api/trans_penjualan/detail_jasa/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Transaksi Service ");
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Transaksi Service")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,noTransPenjualan){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Transaksi Service?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,noTransPenjualan);
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
