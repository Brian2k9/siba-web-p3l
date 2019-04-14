
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Cabang</h3>
                  </div>

                <div class="card-body">
                  <div align="center">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Cabang</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Cabang" v-model="cabang.nama_cabang" autofocus=""/>
                        <span v-if="errors.nama_cabang" class="help is-danger"> {{ errors.nama_cabang[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat Cabang</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Alamat Cabang" v-model="cabang.alamat_cabang" autofocus=""/>
                        <span v-if="errors.alamat_cabang" class="help is-danger"> {{ errors.alamat_cabang[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nomor Telepon Cabang</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nomor Telepon Cabang" v-model="cabang.no_telp_cabang" @input="onlyNumbers" autofocus=""/>
                        <span v-if="errors.no_telp_cabang" class="help is-danger"> {{ errors.no_telp_cabang[0]}}</span>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Ubah  &nbsp; <i class="fa fa-edit"></i></button>
                          <router-link to = "/cabang" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        cabang: {
            nama_cabang: '',
            alamat_cabang: '',
            no_telp_cabang: '',
        },
        cabangId : null,
        errors: [],
        message: '',
      }
    },
    mounted()  {
     var app = this;
     this.cabangId = this.$route.params.id;
     axios.get('/api/cabang/'+this.cabangId)
     .then((resp) => {
       this.cabang =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat cabang");    
     });
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Cabang",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newCabang = this.cabang;
        axios.put('/api/cabang/update/' + this.cabangId ,newCabang)
        .then((resp) => {
          this.alert('Berhasil Mengubah Cabang ');
          this.$router.replace('/cabang');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Cabang');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.cabang.no_telp_cabang = this.cabang.no_telp_cabang.replace(/[^0-9-]/g,'');
      }
    }
  }

</script>
