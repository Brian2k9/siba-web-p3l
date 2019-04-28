
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Transaksi</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Pelanggan</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="transaksiPenjualan.id_pelanggan"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Pelanggan</option>
                            <option v-for="pelanggan in pelanggans" :value="pelanggan.id">{{ pelanggan.nama_pelanggan }}</option>
                          </select>
                        <span v-if="errors.id_pelanggan" class="help is-danger"> {{ errors.id_pelanggan[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Cabang</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="transaksiPenjualan.id_cabang"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Cabang</option>
                            <option v-for="cabang in cabangs" :value="cabang.id">{{ cabang.nama_cabang }}</option>
                          </select>
                        <span v-if="errors.id_cabang" class="help is-danger"> {{ errors.id_cabang[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nomor Plat Kendaraan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nomor Plat Kendaraan" v-model="transaksiPenjualan.no_plat_kendaraan" autofocus=""/>
                        <span v-if="errors.no_plat_kendaraan" class="help is-danger"> {{ errors.no_plat_kendaraan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Tanggal Penjualan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Tanggal Penjualan" v-model="transaksiPenjualan.tanggal_penjualan" @input="onlyNumbers" autofocus=""/>
                        <span v-if="errors.tanggal_penjualan" class="help is-danger"> {{ errors.tanggal_penjualan[0]}}</span>
                        </div>
                      </div>
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/trans_penjualan" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
            id_pelanggan: '',
            id_cabang: '',
            no_plat_kendaraan: '',
            tanggal_penjualan: '',
        },
        pelanggans: [],
        cabangs: [],
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getPelanggans();
     app.getCabangs();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Transaksi",
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
        axios.post('/api/trans_penjualan/store',newTransPenjualan)
        .then((resp) => {
          this.alert('Berhasil Menambah Transaksi ');
          this.$router.replace('/trans_penjualan');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Transaksi');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.transaksiPenjualan.tanggal_penjualan = this.transaksiPenjualan.tanggal_penjualan.replace(/[^0-9-]/g,'');
      }
    }
  }

</script>
