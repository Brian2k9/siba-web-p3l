
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Detail Pengadaan Sparepart</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                       <br>
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
                          <button class="button is-success" type="submit">Ubah  &nbsp; <i class="fa fa-edit"></i></button>
                          <button class="button is-warning" type="button" @click="kembali">Batal  &nbsp; <i class="fas fa-window-close"></i></button>
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
            //id_trans_pengadaan: '',   
            id_sparepart: '',
            jumlah_pengadaan: '',
        },
        transPengadaan: [],
        spareparts: [],
        detailtransPengadaanId : null,
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.detailtransPengadaanId = this.$route.params.id;
     axios.get('/api/detail_trans_pengadaan/'+this.detailtransPengadaanId)
     .then((resp) => {
       this.detailPengadaan =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat transaksi pengadaan sparepart");    
     });
     
     app.getTransPengadaan();
     app.getSpareparts();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Detail Transaksi Pengadaan Sparepart",
          text: pesan,
          icon: "success"
        });
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
      saveForm(){
        var newDetailTransPengadaan = this.detailPengadaan;
        axios.put('/api/detail_trans_pengadaan/update/' + this.detailtransPengadaanId ,newDetailTransPengadaan)
        .then((resp) => {
          this.alert('Berhasil Mengubah Detail Transaksi Pengadaan Sparepart ');
          //this.$router.replace('/trans_pengadaan');
          this.$router.go(-1);
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Detail Transaksi Pengadaan Sparepart');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.detailPengadaan.jumlah_pengadaan = this.detailPengadaan.jumlah_pengadaan.replace(/[^0-9]/g,'');
      },
      kembali(){
        this.$router.go(-1);
      }
    }
  }

</script>
