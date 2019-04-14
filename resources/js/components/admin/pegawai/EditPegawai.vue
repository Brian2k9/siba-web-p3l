
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Pegawai</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >ID Role</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="ID Role" v-model="pegawai.id_role" autofocus=""/>
                        <span v-if="errors.id_role" class="help is-danger"> {{ errors.id_role[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Pegawai</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Pegawai" v-model="pegawai.nama_pegawai" autofocus=""/>
                        <span v-if="errors.nama_pegawai" class="help is-danger"> {{ errors.nama_pegawai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat Pegawai</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Alamat Pegawai" v-model="pegawai.alamat_pegawai" autofocus=""/>
                        <span v-if="errors.alamat_pegawai" class="help is-danger"> {{ errors.alamat_pegawai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nomor Telepon Pegawai</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nomor Telepon Pegawai" v-model="pegawai.no_telp_pegawai" @input="onlyNumbers" autofocus=""/>
                        <span v-if="errors.no_telp_pegawai" class="help is-danger"> {{ errors.no_telp_pegawai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Gaji Per Minggu</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Gaji Per Minggu" v-model="pegawai.gaji_perminggu" autofocus=""/>
                        <span v-if="errors.gaji_perminggu" class="help is-danger"> {{ errors.gaji_perminggu[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Password Pegawai</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Password Pegawai" v-model="pegawai.password_pegawai" autofocus=""/>
                        <span v-if="errors.password_pegawai" class="help is-danger"> {{ errors.password_pegawai[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >ID Cabang</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="ID Cabang" v-model="pegawai.id_cabang" autofocus=""/>
                        <span v-if="errors.id_cabang" class="help is-danger"> {{ errors.id_cabang[0]}}</span>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Ubah  &nbsp; <i class="fa fa-edit"></i></button>
                          <router-link to = "/pegawai" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        pegawai: {
            id_role: '',
            nama_pegawai: '',
            alamat_pegawai: '',
            no_telp_pegawai: '',
            gaji_perminggu: '',
            password_pegawai: '',
            id_cabang: '',
        },
        pegawaiId : null,
        errors: [],
        message: '',
      }
    },
    mounted()  {
     var app = this;
     this.pegawaiId = this.$route.params.id;
     axios.get('/api/pegawai/'+this.pegawaiId)
     .then((resp) => {
       this.pegawai =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat pegawai");    
     });
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Pegawai",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newPegawai = this.pegawai;
        axios.put('/api/pegawai/update/' + this.pegawaiId ,newPegawai)
        .then((resp) => {
          this.alert('Berhasil Mengubah Pegawai ');
          this.$router.replace('/pegawai');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Pegawai');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.pegawai.no_telp_pegawai = this.pegawai.no_telp_pegawai.replace(/[^0-9]/g,'');
      }
    }
  }

</script>
