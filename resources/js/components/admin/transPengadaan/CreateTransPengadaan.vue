
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Transaksi Pengadaan Sparepart</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Supplier</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="transaksiPengadaan.id_supplier"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Supplier</option>
                            <option v-for="supplier in suppliers" :value="supplier.id">{{ supplier.nama_supplier }}</option>
                          </select>
                        <span v-if="errors.id_supplier" class="help is-danger"> {{ errors.id_supplier[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Cabang</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="transaksiPengadaan.id_cabang"
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
                        <label for="name" class="col-md-2 control-label" >Tanggal Pengadaan</label>
                        <div class="col-md-4">
                          <input type="date" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="" v-model="transaksiPengadaan.tanggal_pengadaan" autofocus=""/>
                        <span v-if="errors.tanggal_pengadaan" class="help is-danger"> {{ errors.tanggal_pengadaan[0]}}</span>
                        </div>
                      </div>
                        <br>
                        <table class="table">
                          <thead>
                            <tr>
                              <td><strong>Sparepart</strong></td>
                              <td><strong>Jumlah Pengadaan</strong></td>
                              <td></td>
                              <td>
                                <div>
                                  <button class="button is-primary" @click="addRow"><i class="fas fa-plus"></i></button>
                                </div>
                              </td>
                            </tr>
                          </thead>
                            <tbody>
                              <tr v-for="(transaksiPengadaan, index) in rows">

                                <td>
                                  
                                  <div class="form-group">
                                    
                                    <div class="select is-primary">
                                      <div class="col-md-4">
                                        <select
                                         v-model="transaksiPengadaan.id_sparepart"
                                         class="form-control"
                                         required="" >
                                          <option value="">Pilih Sparepart</option>
                                          <option v-for="sparepart in spareparts" :value="sparepart.id">{{ sparepart.kode_sparepart }}</option>
                                        </select>
                                        <span v-if="errors.id_sparepart" class="help is-danger"> {{ errors.id_sparepart[0]}}</span>
                                      </div>
                                      </div>
                                    </div>
                                
                                </td>
                                <td>
                                  <div class="form-group">
                                     <div class="col-md-4">
                                      <input type="text" v-bind:style="{width: '25%' }" class="input is-primary" required="" placeholder="" v-model="transaksiPengadaan.jumlah_pengadaan" @input="onlyNumbers" autofocus=""/>
                                      <span v-if="errors.jumlah_pengadaan" class="help is-danger"> {{ errors.jumlah_pengadaan[0]}}</span>
                                     </div>
                                  </div>
                                </td>
                                <td>
                                   <a v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
                                </td>


                              </tr>
                            </tbody>
                          </table>
                          
                      
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/trans_pengadaan" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
            id_supplier: '',
            id_cabang: '',
            tanggal_pengadaan: '',   
            id_sparepart: '',
            jumlah_pengadaan: '',
        },
        suppliers: [],
        cabangs: [],
        spareparts: [],
        transPengadaan: [],
        rows: [],
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getSuppliers();
     app.getCabangs();
     app.getSpareparts();
     app.getTransPengadaan();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Transaksi Pengadaan",
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
      addRow: function() {
            var elem = document.createElement('tr');
            this.rows.push(this.transaksiPengadaan);
      },
      removeElement: function(index) {
        this.rows.splice(index, 1);
      },
      saveForm(){
        var newTransPengadaan = this.transaksiPengadaan;
        axios.post('/api/trans_pengadaan/store',newTransPengadaan)
        .then((resp) => {
          this.alert('Berhasil Menambah Transaksi Pengadaan ');
          this.$router.replace('/trans_pengadaan');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Transaksi Pengadaan');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.transaksiPengadaan.jumlah_pengadaan = this.transaksiPengadaan.jumlah_pengadaan.replace(/[^0-9]/g,'');
      }
    }
  }

</script>


