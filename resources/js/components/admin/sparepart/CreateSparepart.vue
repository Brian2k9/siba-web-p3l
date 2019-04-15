
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Tambah Sparepart</h3>
                  </div>

                <div class="card-body">
                 
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal">
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Kode Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Kode Sparepart" v-model="sparepart.kode_sparepart" autofocus=""/>
                        <span v-if="errors.kode_sparepart" class="help is-danger"> {{ errors.kode_sparepart[0]}}</span>
                        </div>

                        <label for="name" class="col-md-2 control-label" >Nama Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Sparepart" v-model="sparepart.nama_sparepart" autofocus=""/>
                        <span v-if="errors.nama_sparepart" class="help is-danger"> {{ errors.nama_sparepart[0]}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Merk Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Merk Sparepart" v-model="sparepart.merk_sparepart" autofocus=""/>
                        <span v-if="errors.merk_sparepart" class="help is-danger"> {{ errors.merk_sparepart[0]}}</span>
                        </div>

                         <label for="name" class="col-md-2 control-label" >Tipe Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Tipe Sparepart" v-model="sparepart.tipe_sparepart" autofocus=""/>
                        <span v-if="errors.tipe_sparepart" class="help is-danger"> {{ errors.tipe_sparepart[0]}}</span>
                        </div>        
                      </div>
                    
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Gambar Sparepart</label>
                        <div class="col-md-4">
                          <div v-if="!image">
                            <h1>Pilih Gambar</h1>
                         </div>
                         <div v-else>
                            <img :src="image" v-bind:style="{width: '100px', height: '100px' }"/> 
                         </div>
                         <input name="image" type="file" @change="onFileSelected" class="form-control"/>
               
                        <span v-if="errors.gambar_sparepart" class="help is-danger"> {{ errors.gambar_sparepart[0]}}</span>
                        </div>

                        <label for="name" class="col-md-2 control-label" >Jumlah Stok Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Jumlah Stok Sparepart" v-model="sparepart.jumlah_stok_sparepart" autofocus=""/>
                        <span v-if="errors.jumlah_stok_sparepart" class="help is-danger"> {{ errors.jumlah_stok_sparepart[0]}}</span>
                        </div>
                      </div>

                      <div class="form-group">
                       <label for="name" class="col-md-2 control-label" >Harga Beli Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Harga Beli Sparepart" v-model="sparepart.harga_beli_sparepart" autofocus=""/>
                        <span v-if="errors.harga_beli_sparepart" class="help is-danger"> {{ errors.harga_beli_sparepart[0]}}</span>
                        </div>

                        <label for="name" class="col-md-2 control-label" >Harga Jual Sparepart</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Harga Jual Sparepart" v-model="sparepart.harga_jual_sparepart" autofocus=""/>
                        <span v-if="errors.harga_jual_sparepart" class="help is-danger"> {{ errors.harga_jual_sparepart[0]}}</span>
                        </div>

                        <label for="name" class="col-md-2 control-label" >Jumlah Minimal</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Jumlah Minimal" v-model="sparepart.jumlah_minimal" autofocus=""/>
                        <span v-if="errors.jumlah_minimal" class="help is-danger"> {{ errors.jumlah_minimal[0]}}</span>
                        </div>
                      </div>

                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Tambah  &nbsp; <i class="fas fa-plus-circle"></i></button>
                          <router-link to = "/sparepart" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        sparepart: {
            kode_sparepart: '',
            nama_sparepart: '',
            merk_sparepart: '',
            tipe_sparepart: '',
            gambar_sparepart: '',
            jumlah_stok_sparepart: '',
            harga_beli_sparepart: '',
            harga_jual_sparepart: '',
            jumlah_minimal: '',   
        },
        image: '',
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
          title: "Berhasil Menambah Sparepart",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newSparepart = this.sparepart;
        axios.post('/api/sparepart/store',newSparepart)
        .then((resp) => {
          this.alert('Berhasil Menambah Sparepart ' + this.sparepart.nama_sparepart );
          this.$router.replace('/sparepart');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Menambah Sparepart');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onFileSelected(e){
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
            return;
            this.createImage(files[0]);
      },
      createImage(files) {
        var image = new Image();
        var reader = new FileReader();
        var vm = this;
        reader.onload = (e) => {
        vm.image  = e.target.result;
        this.sparepart.gambar_sparepart = e.target.result;
        };
        reader.readAsDataURL(files);
      },
      
    }
  }

</script>
