
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Pelanggan</h3>
                  </div>

                <div class="card-body">
                  <div align="center">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Pelanggan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Pelanggan" v-model="pelanggan.nama_pelanggan" autofocus=""/>
                        <span v-if="errors.nama_pelanggan" class="label label-danger"> {{ errors.nama_pelanggan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat Pelanggan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Alamat Pelanggan" v-model="pelanggan.alamat_pelanggan" autofocus=""/>
                        <span v-if="errors.alamat_pelanggan" class="label label-danger"> {{ errors.alamat_pelanggan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nomor Telepon Pelanggan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nomor Telepon Pelanggan" v-model="pelanggan.no_telp_pelanggan" @input="onlyNumbers" autofocus=""/>
                        <span v-if="errors.no_telp_pelanggan" class="label label-danger"> {{ errors.no_telp_pelanggan[0]}}</span>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah</button>
                          <router-link to = "/pelanggan" class="button is-warning">Batal</router-link>
                        </div>
                      </div>
                      <br>
                    </form>
                  </div>
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
        pelanggan: {
          nama_pelanggan: '',
          alamat_pelanggan: '',
          no_telp_pelanggan: ''
        },
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Pelanggan",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPelanggan = this.pelanggan;
        axios.post('/api/pelanggan/store',newPelanggan)
        .then((resp) => {
          this.alert('Berhasil Menambah Pelanggan ' + this.pelanggan.nama_pelanggan );
          this.$router.replace('/pelanggan');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Pelanggan');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.pelanggan.no_telp_pelanggan = this.pelanggan.no_telp_pelanggan.replace(/[^0-9.]/g,'');
     }
    }
  }

</script>
