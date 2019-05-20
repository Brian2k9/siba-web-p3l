
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Transaksi Sparepart</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Sparepart</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="detail_trans_sparepart.id_sparepart"
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
                        <label for="name" class="col-md-2 control-label" >Jumlah Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Jumlah Sparepart" v-model="detail_trans_sparepart.jumlah_barang" autofocus=""/>
                        <span v-if="errors.jumlah_barang" class="help is-danger"> {{ errors.jumlah_barang[0]}}</span>
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
        detail_trans_sparepart: {
            //id_trans_penjualan: '',
            id_sparepart: '',
            jumlah_barang: '',
        },
        transaksiPenjualan: [],
        spareparts: [],
        transSparepartId : null,
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     this.transSparepartId = this.$route.params.id;
     axios.get('/api/trans_penjualan/detail_spare/'+this.transSparepartId)
     .then((resp) => {
       this.detail_trans_sparepart =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat transaksi sparepart");    
     });
     
     app.getTransaksiPenjualan();
     app.getSpareparts();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Transaksi Sparepart",
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
        var newDetailTransSparepart = this.detail_trans_sparepart;
        axios.put('/api/trans_penjualan/detail_spare/update/' + this.transSparepartId ,newDetailTransSparepart)
        .then((resp) => {
          this.alert('Berhasil Mengubah Transaksi Sparepart ');
          //this.$router.replace('/detail_trans_sparepart');
          this.$router.go(-1);
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Transaksi Sparepart');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      kembali(){
        this.$router.go(-1);
      }
    }
  }

</script>
