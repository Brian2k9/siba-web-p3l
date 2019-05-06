<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Daftar Transaksi Sparepart</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_trans_sparepart" class="button is-success">Tambah Transaksi Sparepart &nbsp; <i class="fas fa-plus-circle"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama sparepart" v-bind:style="{width: '25%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th>Nomor Transaksi Penjualan</th>
                        <th>Sparepart</th>
                        <th>Jumlah Sparepart</th>
                        <th>Total Harga Sparepart</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(detail_trans_sparepart,index) in filteredList" :key ="detail_trans_sparepart.id">
                        <td>{{ detail_trans_sparepart.id_trans_penjualan }}</td>
                        <td>{{ detail_trans_sparepart.sparepart.kode_sparepart }}</td>
                        <td>{{ detail_trans_sparepart.jumlah_barang }}</td>
                        <td>{{ detail_trans_sparepart.total_harga_spare }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editTransaksiSparepart' ,params:{id: detail_trans_sparepart.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(detail_trans_sparepart.id,index)">
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
                        :data="detail_transsparepartData" @pagination-change-page="getResults" :limit="4">
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
        detail_transsparepart: [],
        detail_transsparepartData: {},
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
         return this.detail_transsparepart.filter((detail_trans_sparepart) => {
           return detail_trans_sparepart.sparepart.kode_sparepart.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/trans_penjualan/detail_spare?page=' + page)
        .then(function(resp){
          app.detail_transsparepart = resp.data.data;
          app.detail_transsparepartData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      
      deleteEntry(id,index){
          axios.delete('/api/trans_penjualan/detail_spare/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Transaksi ");
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Transaksi")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Transaksi ?",
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
