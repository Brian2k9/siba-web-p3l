<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">Detail Pengadaan Sparepart</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to = "/trans_pengadaan" class="button is-warning"> <i class="fas fa-arrow-left"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari sparepart" v-bind:style="{width: '25%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th>Nomor Transaksi Pengadaan</th>
                        <th>Kode Sparepart</th>
                        <th>Nama Sparepart</th>
                        <th>Jumlah Stok</th>
                        <th>Jumlah Pengadaan</th>
                        <th>Subtotal</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(detail_trans_pengadaan,index) in filteredList" :key ="detail_trans_pengadaan.id">
                        <td>{{ detail_trans_pengadaan.id_trans_pengadaan }}</td>
                        <td>{{ detail_trans_pengadaan.sparepart.kode_sparepart }}</td>
                        <td>{{ detail_trans_pengadaan.sparepart.nama_sparepart }}</td>
                        <td>{{ detail_trans_pengadaan.sparepart.jumlah_stok_sparepart }}</td>
                        <td>{{ detail_trans_pengadaan.jumlah_pengadaan }}</td>
                        <td>{{ detail_trans_pengadaan.subtotal_pengadaan }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editDetailPengadaan' ,params:{id: detail_trans_pengadaan.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(detail_trans_pengadaan.id,index)">
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
        detail_pengadaan: [],
        //detail_pengadaanData: {},
        pencarian: '',
        //loading: true,
        transPengadaanId: null,
      }
    },
    mounted()  {
     var app = this;
    //  this.transPengadaanId = this.$route.params.id;
    //  axios.get('/api/trans_pengadaan/showDetail/'+this.transPengadaanId)
    //  .then((resp) => {
    //    this.detail_pengadaan =  resp.data;
    //  })
    //  .catch((resp) => {
    //     alert("Gagal memuat detail transaksi pengadaan sparepart");    
    //  });
    app.getResults();
    },
    computed: {
       filteredList: function(){
         return this.detail_pengadaan.filter((detail_trans_pengadaan) => {
           return detail_trans_pengadaan.sparepart.kode_sparepart.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(){
        this.transPengadaanId = this.$route.params.id;
        axios.get('/api/trans_pengadaan/showDetail/'+this.transPengadaanId)
          .then((resp) => {
            this.detail_pengadaan =  resp.data;
        })
          .catch((resp) => {
          alert("Gagal memuat detail transaksi pengadaan sparepart");    
        });
      },
      
      deleteEntry(id,index){
          axios.delete('/api/detail_trans_pengadaan/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Detail Transaksi Pengadaan ");
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Detail Transaksi Pengadaan")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Detail Transaksi Pengadaan ?",
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
