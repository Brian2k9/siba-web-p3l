<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Daftar Transaksi Penjualan</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_trans_penjualan" class="button is-success">Tambah Transaksi &nbsp; <i class="fas fa-plus-circle"></i></router-link>
                      <router-link to="/tambah_trans_jasa" class="button is-info">Tambah Jasa &nbsp; <i class="fas fa-plus-circle"></i></router-link>
                      <router-link to="/tambah_trans_sparepart" class="button is-warning">Tambah Sparepart &nbsp; <i class="fas fa-plus-circle"></i></router-link>
                      <router-link to="/trans_penjualan_pembayaran" class="button is-dark">Pembayaran &nbsp; <i class="fas fa-money-bill-wave"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan plat" v-bind:style="{width: '20%' }" v-model="pencarian" />
                      <input type="checkbox" id="checkbox" v-model="checked">
                      <h7>Selesai transaksi</h7>
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th class="id-row">ID</th>
                        <th>Pelanggan</th>
                        <th>Cabang</th>
                        <th>Total Harga Transaksi</th>
                        <th>Diskon Penjualan</th>
                        <th>Grand Total</th>
                        <th>Status Transaksi</th>
                        <th>Status Pembayaran</th>
                        <th>Nomor Plat</th>
                        <th>Tanggal</th>
                        <th class="row-Modify">Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(transaksi,index) in filteredList" :key ="transaksi.id">
                        <td>{{ transaksi.id }}</td>
                        <td>{{ transaksi.pelanggan.nama_pelanggan }}</td>
                        <td>{{ transaksi.cabang.nama_cabang }}</td>
                        <td>{{ transaksi.total_harga_trans }}</td>
                        <td>{{ transaksi.discount_penjualan }}%</td>
                        <td>{{ transaksi.grand_total }}</td>
                        <td>{{ transaksi.status_transaksi }}</td>
                        <td>{{ transaksi.status_pembayaran }}</td>
                        <td>{{ transaksi.no_plat_kendaraan }}</td>
                        <td>{{ transaksi.tanggal_penjualan }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editTransaksi' ,params:{id: transaksi.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(transaksi.id,index,transaksi.no_plat_kendaraan)">
                          <i class="fa fa-trash"></i>
                        </button>
                        <router-link 
                          :to="{name:'showDetailSparepart' ,params:{id: transaksi.id}}" 
                          class="button is-dark">
                          <i class="fas fa-cogs"></i>
                       </router-link>
                       <router-link 
                          :to="{name:'showDetailJasa' ,params:{id: transaksi.id}}" 
                          class="button is-dark">
                          <i class="fas fa-tools"></i>
                       </router-link>
                        <router-link 
                          :to="{name:'printSPK' ,params:{id: transaksi.id}}" 
                          class="button is-info">
                          <i class="fas fa-print"></i>
                       </router-link>
                        </td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                   </div>     
                    <div class="card-footer">
                      <pagination class="card-footer-item"
                        :data="transaksiPenjualanData" @pagination-change-page="getResults" :limit="4">
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
        transaksiPenjualan: [],
        transaksiPenjualanData: {},
        pencarian: '',
        loading: true,
        checked: false
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    computed: {
       filteredList: function(){
         if (this.checked) {
            return this.transaksiPenjualan.filter((transaksi) => {
              return transaksi.status_transaksi === 'sudah'
            })
         }
         return this.transaksiPenjualan.filter((transaksi) => {
           return transaksi.no_plat_kendaraan.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/trans_penjualan?page=' + page)
        .then(function(resp){
          app.transaksiPenjualan = resp.data.data;
          app.transaksiPenjualanData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      
      deleteEntry(id,index,nomorPlat){
          axios.delete('/api/trans_penjualan/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Transaksi " + nomorPlat);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Transaksi")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,nomorPlat){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Transaksi " + nomorPlat + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,nomorPlat);
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
