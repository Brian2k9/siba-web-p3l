
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Transaksi Service</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >ID Trans Penjualan</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="detailTransJasa.id_trans_penjualan"
                          class="form-control"
                          required="" >
                            <option value="">Pilih ID Trans Penjualan</option>
                            <option v-for="transaksi in transaksiPenjualan" :value="transaksi.id">{{ transaksi.id }}</option>
                          </select>
                        <span v-if="errors.id_trans_penjualan" class="help is-danger"> {{ errors.id_trans_penjualan[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jasa Service</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="detailTransJasa.id_jasa"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Jasa Service</option>
                            <option v-for="jasa_service in jasa_services" :value="jasa_service.id">{{ jasa_service.nama_jasa }}</option>
                          </select>
                        <span v-if="errors.id_jasa" class="help is-danger"> {{ errors.id_jasa[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Pegawai</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="detailTransJasa.id_pegawai"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Pegawai</option>
                            <option v-for="pegawai in pegawais" :value="pegawai.id">{{ pegawai.nama_pegawai }}</option>
                          </select>
                        <span v-if="errors.id_pegawai" class="help is-danger"> {{ errors.id_pegawai[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kendaraan</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="detailTransJasa.id_kendaraan"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Kendaraan</option>
                            <option v-for="kendaraan in kendaraans" :value="kendaraan.id">{{ kendaraan.tipe_kendaraan }}</option>
                          </select>
                        <span v-if="errors.id_kendaraan" class="help is-danger"> {{ errors.id_kendaraan[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Jumlah Jasa</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Jumlah Jasa" v-model="detailTransJasa.jumlah_jasa" autofocus=""/>
                        <span v-if="errors.jumlah_jasa" class="help is-danger"> {{ errors.jumlah_jasa[0]}}</span>
                        </div>
                      </div>
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/detail_trans_jasa" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        detailTransJasa: {
            id_trans_penjualan: '',
            id_jasa: '',
            id_pegawai: '',
            id_kendaraan: '',
            jumlah_jasa: '',
        },
        transaksiPenjualan: [],
        jasa_services: [],
        pegawais: [],
        kendaraans: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getTransaksiPenjualan();
     app.getJasas();
     app.getPegawais();
     app.getKendaraans();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Transaksi Service",
          text: pesan,
          icon: "success"
        });
      },
      getTransaksiPenjualan(){
        var app = this;
        axios.get('/api/trans_penjualan' + '/all')
        .then(function(resp){
          app.transaksiPenjualan = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getJasas(){
        var app = this;
        axios.get('/api/jasa_service' + '/all')
        .then(function(resp){
          app.jasa_services = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getPegawais(){
        var app = this;
        axios.get('/api/pegawai' + '/all')
        .then(function(resp){
          app.pegawais = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getKendaraans(){
        var app = this;
        axios.get('/api/kendaraan' + '/all')
        .then(function(resp){
          app.kendaraans = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      saveForm(){
        var newDetailTransJasa = this.detailTransJasa;
        axios.post('/api/detail_trans_jasa/store',newDetailTransJasa)
        .then((resp) => {
          this.alert('Berhasil Menambah Transaksi Service ');
          this.$router.replace('/detail_trans_jasa');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Transaksi Service');
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
