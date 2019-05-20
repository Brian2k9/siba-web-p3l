<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Konfirmasi Pengiriman Pengadaan Sparepart</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <br>
                      <div align="left">
                          <h1>Apakah Barang Sudah Sampai Tujuan?</h1>
                      </div>
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-info" type="submit">Confirm  &nbsp; <i class="fas fa-check"></i></button>
                          <router-link to = "/trans_pengadaan_konfirmasi" class="button is-warning">Kembali  &nbsp; <i class="fas fa-window-close"></i></router-link>
                        </div>
                      </div>
                      <br>
                    </form>
                  
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
         transaksiPengadaan: {
            status_pengadaan: '',   
        },
        suppliers: [],
        cabangs: [],
        transPengadaanId : null,
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.transPengadaanId = this.$route.params.id;
     axios.get('/api/trans_pengadaan/'+this.transPengadaanId)
     .then((resp) => {
       this.transaksiPengadaan =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat transaksi pengadaan");    
     });
     
    app.getSuppliers();
    app.getCabangs();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Transaksi Pengadaan Selesai",
          text: pesan,
          icon: "success"
        });
      },
      getSuppliers(){
        var app = this;
        axios.get('/api/supplier' + '/all')
        .then(function(resp){
          app.suppliers = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getCabangs(){
        var app = this;
        axios.get('/api/cabang' + '/all')
        .then(function(resp){
          app.cabangs = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      saveForm(){
        var newTransPengadaan = this.transaksiPengadaan;
        axios.put('/api/trans_pengadaan/konfirmasi/' + this.transPengadaanId ,newTransPengadaan)
        .then((resp) => {
          this.alert('Barang sudah sampai tujuan ');
          this.$router.replace('/trans_pengadaan_konfirmasi');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Barang belum dikirim');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
   
    }
  }
</script>