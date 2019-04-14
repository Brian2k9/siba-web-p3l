
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Role</h3>
                  </div>

                <div class="card-body">
                  <div align="center">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                       <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Role</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Role" v-model="role.nama_role" autofocus=""/>
                        <span v-if="errors.nama_role" class="help is-danger"> {{ errors.nama_role[0]}}</span>
                        </div>
                      </div>
                     
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Ubah &nbsp; <i class="fa fa-edit"></i></button>
                          <router-link to = "/role" class="button is-warning">Batal &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        role: {
          nama_role: '',
        },
        roleId : null,
        errors: [],
        message: '',
      }
    },
    mounted()  {
     var app = this;
     this.roleId = this.$route.params.id;
     axios.get('/api/role/'+this.roleId)
     .then((resp) => {
       this.role =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat role");    
     });
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Role",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newRole = this.role;
        axios.put('/api/role/update/' + this.roleId ,newRole)
        .then((resp) => {
          this.alert('Berhasil Mengubah Role ');
          this.$router.replace('/role');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Role');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      }
    }
  }

</script>
