
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Pegawai</h3>
                  </div>

                <div class="card-body">
                  
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Role</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="pegawai.id_role"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Role</option>
                            <option v-for="role in roles" :value="role.id">{{ role.nama_role }}</option>
                          </select>
                        <span v-if="errors.id_role" class="help is-danger"> {{ errors.id_role[0]}}</span>
                        </div>
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
                        <label for="name" class="col-md-2 control-label" >Cabang</label>
                        <br>
                        <div class="select is-primary">
                        <div class="col-md-4">
                          <select
                          v-model="pegawai.id_cabang"
                          class="form-control"
                          required="" >
                            <option value="">Pilih Cabang</option>
                            <option v-for="cabang in cabangs" :value="cabang.id">{{ cabang.nama_cabang }}</option>
                          </select>
                        <span v-if="errors.id_cabang" class="help is-danger"> {{ errors.id_cabang[0]}}</span>
                        </div>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
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
        roles: [],
        cabangs: [],
        errors: [],
        message: ''
      }
    },
    mounted()  {
     var app = this;
     app.getRoles();
     app.getCabangs();
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Menambah Pegawai",
          text: pesan,
          icon: "success"
        });
      },
      getRoles(){
        var app = this;
        axios.get('/api/role' + '/all')
        .then(function(resp){
          app.roles = resp.data;
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
      saveForm(){
        var newPegawai = this.pegawai;
        axios.post('/api/pegawai/store',newPegawai)
        .then((resp) => {
          this.alert('Berhasil Menambah Pegawai ' + this.pegawai.nama_pegawai );
          this.$router.replace('/pegawai');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Pegawai');
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
