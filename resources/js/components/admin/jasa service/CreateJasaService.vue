
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Jasa Service</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Jasa</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Jasa" v-model="jasa.nama_jasa" autofocus=""/>
                        <span v-if="errors.nama_jasa" class="help is-danger"> {{ errors.nama_jasa[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Harga Jasa</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Harga Jasa" v-model="jasa.harga_jasa" autofocus=""/>
                        <span v-if="errors.harga_jasa" class="help is-danger"> {{ errors.harga_jasa[0]}}</span>
                        </div>
                      </div>
                     
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/jasa_service" class="button is-warning">Batal &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        jasa: {
            nama_jasa: '',
            harga_jasa: '',
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
          title: "Berhasil Menambah Jasa Services",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newJasa = this.jasa;
        axios.post('/api/jasa_service/store',newJasa)
        .then((resp) => {
          this.alert('Berhasil Menambah Jasa Service ' + this.jasa.nama_jasa );
          this.$router.replace('/jasa_service');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Jasa Service');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      }
    }
  }

</script>
