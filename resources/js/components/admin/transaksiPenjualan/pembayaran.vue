
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Pembayaran</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                     
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Discount Penjualan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Discount" v-model="transaksiPenjualan.discount_penjualan" autofocus=""/>%
                        <span v-if="errors.discount_penjualan" class="help is-danger"> {{ errors.discount_penjualan[0]}}</span>
                        </div>
                      </div>
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Bayar  &nbsp; <i class="fas fa-money-bill-wave"></i></button>
                          <router-link to = "/trans_penjualan_pembayaran" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        transaksiPenjualan: {
            discount_penjualan: '',
        },
        pelanggans: [],
        cabangs: [],
        transId : null,
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.transId = this.$route.params.id;
     axios.get('/api/trans_penjualan/SPK/'+this.transId)
     .then((resp) => {
       this.transaksiPenjualan =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat transaksi");    
     });
     
    app.getPelanggans();
    app.getCabangs();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Transaksi Selesai",
          text: pesan,
          icon: "success"
        });
      },
      getPelanggans(){
        var app = this;
        axios.get('/api/pelanggan' + '/all')
        .then(function(resp){
          app.pelanggans = resp.data;
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
        var newTransPenjualan = this.transaksiPenjualan;
        axios.put('/api/trans_penjualan/pembayaran/' + this.transId ,newTransPenjualan)
        .then((resp) => {
          this.alert('Transaksi Selesai ');
          this.$router.replace('/trans_penjualan_pembayaran');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Transaksi Belum selesai');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
    //   onlyNumbers: function() {
    //    this.transaksiPenjualan.tanggal_penjualan = this.transaksiPenjualan.tanggal_penjualan.replace(/[^0-9-]/g,'');
    //   }
    }
  }

</script>
