
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Kendaraan</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Merk Kendaraan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Merk Kendaraan" v-model="kendaraan.merk_kendaraan" autofocus=""/>
                        <span v-if="errors.merk_kendaraan" class="help is-danger"> {{ errors.merk_kendaraan[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Tipe Kendaraan</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Tipe Kendaraan" v-model="kendaraan.tipe_kendaraan" autofocus=""/>
                        <span v-if="errors.tipe_kendaraan" class="help is-danger"> {{ errors.tipe_kendaraan[0]}}</span>
                        </div>
                      </div>
                     
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/kendaraan" class="button is-warning">Batal &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        kendaraan: {
          merk_kendaraan: '',
          tipe_kendaraan: '',
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
          title: "Berhasil Menambah Kendaraan",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newKendaraan = this.kendaraan;
        axios.post('/api/kendaraan/store',newKendaraan)
        .then((resp) => {
          this.alert('Berhasil Menambah Kendaraan ' + this.kendaraan.merk_kendaraan );
          this.$router.replace('/kendaraan');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Kendaraan');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      }
    }
  }

</script>
