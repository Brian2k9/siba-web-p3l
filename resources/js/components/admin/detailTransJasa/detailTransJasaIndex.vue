<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Daftar Transaksi Penjualan Service</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to = "/trans_penjualan" class="button is-warning"> <i class="fas fa-arrow-left"></i></router-link>
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
                      <tr v-for="(detail_trans_jasa,index) in filteredList" :key ="detail_trans_jasa.id">
                        <td>{{ detail_trans_jasa.id_trans_penjualan }}</td>
                        <td>{{ detail_trans_jasa.jasa_service.nama_jasa }}</td>
                        <td>{{ detail_trans_jasa.pegawai.nama_pegawai }}</td>
                        <td>{{ detail_trans_jasa.kendaraan.tipe_kendaraan }}</td>
                        <td>{{ detail_trans_jasa.jumlah_jasa }}</td>
                        <td>{{ detail_trans_jasa.total_harga_jasa }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editDetailTransJasa' ,params:{id: detail_trans_jasa.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(detail_trans_jasa.id,index)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>     
                             
                   </div>     
                    <div class="card-footer">
                      
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
        detail_transjasa: [],
        
        pencarian: '',
        //loading: true,
        detailTransJasaId: null,
      }
    },
    mounted()  {
     var app = this;
     app.getResults();
    },
    computed: {
       filteredList: function(){
         return this.detail_transjasa.filter((detail_trans_jasa) => {
           return detail_trans_jasa.jasa_service.nama_jasa.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(){
        this.detailTransJasaId = this.$route.params.id;
        axios.get('/api/trans_penjualan/showDetailJasa/'+this.detailTransJasaId)
          .then((resp) => {
            this.detail_transjasa =  resp.data;
        })
          .catch((resp) => {
          alert("Gagal memuat detail transaksi jasa");    
        });
      },
      
      deleteEntry(id,index){
          axios.delete('/api/trans_penjualan/detail_jasa/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Detail Transaksi Jasa ");
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Detail Transaksi Jasa")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Detail Transaksi Jasa ?",
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
