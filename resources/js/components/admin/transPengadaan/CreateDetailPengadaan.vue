
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Detail Transaksi Pengadaan Sparepart</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                        <br>
                                  
                                  <div class="form-group">
                                    <label for="name" class="col-md-2 control-label" >ID Transaksi Pengadaan</label>
                                    <br>
                                    <div class="select is-primary">
                                      <div class="col-md-4">
                                        <select
                                         v-model="detailPengadaan.id_trans_pengadaan"
                                         class="form-control"
                                         required="" >
                                          <option value="">Pilih ID Transaksi</option>
                                          <option v-for="trans_pengadaan in transPengadaan" :value="trans_pengadaan.id">{{ trans_pengadaan.id }}</option>
                                        </select>
                                        <span v-if="errors.id_trans_pengadaan" class="help is-danger"> {{ errors.id_trans_pengadaan[0]}}</span>
                                      </div>
                                      </div>
                                    </div>
                                
                               

                               
                                  
                                  <div class="form-group">
                                    <label for="name" class="col-md-2 control-label" >Sparepart</label>
                                    <br>
                                    <div class="select is-primary">
                                      <div class="col-md-4">
                                        <select
                                         v-model="detailPengadaan.id_sparepart"
                                         class="form-control"
                                         required="" >
                                          <option value="">Pilih Sparepart</option>
                                          <option v-for="sparepart in spareparts" :value="sparepart.id">{{ sparepart.kode_sparepart }}</option>
                                        </select>
                                        <span v-if="errors.id_sparepart" class="help is-danger"> {{ errors.id_sparepart[0]}}</span>
                                      </div>
                                      </div>
                                    </div>
                                
                               
                               
                                  <div class="form-group">
                                     <label for="name" class="col-md-2 control-label" >Jumlah Pengadaan</label>
                                     <div class="col-md-4">
                                      <input type="text" v-bind:style="{width: '25%' }" class="input is-primary" required="" placeholder="jumlah pengadaan" v-model="detailPengadaan.jumlah_pengadaan" @input="onlyNumbers" autofocus=""/>
                                      <span v-if="errors.jumlah_pengadaan" class="help is-danger"> {{ errors.jumlah_pengadaan[0]}}</span>
                                     </div>
                                  </div>
                          
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button v-on:click="isHidden = false" class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/trans_pengadaan" v-if="isHidden" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
                          <router-link to = "/trans_pengadaan" v-if="!isHidden" class="button is-info">Selesai  &nbsp; <i class="fas fa-check"></i></router-link>
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
        detailPengadaan: {
            id_trans_pengadaan: '',   
            id_sparepart: '',
            jumlah_pengadaan: '',
        },
        spareparts: [],
        transPengadaan: [],
        errors: [],
        message: '',
        isHidden: true,
      }
    },
    mounted()  {
     var app = this;
     app.getSpareparts();
     app.getTransPengadaan();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Detail Transaksi Pengadaan",
          text: pesan,
          icon: "success"
        });
      },
      getSpareparts(){
        var app = this;
        axios.get('/api/sparepart' + '/all')
        .then(function(resp){
          app.spareparts = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getTransPengadaan(){
        var app = this;
        axios.get('/api/trans_pengadaan' + '/all')
        .then(function(resp){
          app.transPengadaan = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      saveForm(){
        var newDetailTransPengadaan = this.detailPengadaan;
        axios.post('/api/detail_trans_pengadaan/store',newDetailTransPengadaan)
        .then((resp) => {
          this.alert('Berhasil Menambah Detail Transaksi Pengadaan ');
          this.$router.replace('/tambah_detail_pengadaan');
          this.detailPengadaan.jumlah_pengadaan = "";
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Detail Transaksi Pengadaan');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.detailPengadaan.jumlah_pengadaan = this.detailPengadaan.jumlah_pengadaan.replace(/[^0-9]/g,'');
      }
    }
  }

</script>


