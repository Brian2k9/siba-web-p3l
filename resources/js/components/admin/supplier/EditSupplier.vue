
<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-header-title">Ubah Supplier</h3>
                  </div>

                <div class="card-body">
                  <div align="center">
                    <form v-on:submit.prevent="saveForm()" class="form-horizontal" >
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nama Supplier</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nama Supplier" v-model="supplier.nama_supplier" autofocus=""/>
                        <span v-if="errors.nama_supplier" class="help is-danger"> {{ errors.nama_supplier[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Sales Supplier</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Sales Supplier" v-model="supplier.sales_supplier" autofocus=""/>
                        <span v-if="errors.sales_supplier" class="help is-danger"> {{ errors.sales_supplier[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Nomor Telepon Supplier</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Nomor Telepon Supplier" v-model="supplier.no_telp_supplier" @input="onlyNumbers" autofocus=""/>
                        <span v-if="errors.no_telp_supplier" class="help is-danger"> {{ errors.no_telp_supplier[0]}}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="name" class="col-md-2 control-label" >Alamat Supplier</label>
                        <div class="col-md-4">
                          <input type="text" v-bind:style="{width: '35%' }" class="input is-primary" required="" placeholder="Alamat Supplier" v-model="supplier.alamat_supplier" autofocus=""/>
                        <span v-if="errors.alamat_supplier" class="help is-danger"> {{ errors.alamat_supplier[0]}}</span>
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                          <button class="button is-success" type="submit">Ubah  &nbsp; <i class="fa fa-edit"></i></button>
                          <router-link to = "/supplier" class="button is-warning">Batal  &nbsp; <i class="fas fa-window-close"></i></router-link>
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
        supplier: {
            nama_supplier: '',
            sales_supplier: '',
            no_telp_supplier: '',
            alamat_supplier: '',
        },
        supplierId : null,
        errors: [],
        message: '',
      }
    },
    mounted()  {
     var app = this;
     this.supplierId = this.$route.params.id;
     axios.get('/api/supplier/'+this.supplierId)
     .then((resp) => {
       this.supplier =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat supplier");    
     });
    },
    methods: {
      alert(pesan){
        this.$swal({
          title: "Berhasil Mengubah Supplier",
          text: pesan,
          icon: "success"
        });
      },
      saveForm(){
        var newSupplier = this.supplier;
        axios.put('/api/supplier/update/' + this.supplierId ,newSupplier)
        .then((resp) => {
          this.alert('Berhasil Mengubah Supplier ');
          this.$router.replace('/supplier');
        })
        .catch((resp) =>{
          if(resp.response.status == 500) alert('Gagal Mengubah Supplier');
          this.errors = resp.response.data.errors;
          console.log(resp);
        });
      },
      onlyNumbers: function() {
       this.supplier.no_telp_supplier = this.supplier.no_telp_supplier.replace(/[^0-9]/g,'');
     }
    }
  }

</script>
