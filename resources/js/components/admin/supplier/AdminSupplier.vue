<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">List Supplier</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_supplier" class="button is-success">Tambah Supplier &nbsp; <i class="fas fa-user-plus fa-fw"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th>Nama Supplier</th>
                        <th>Sales Supplier</th>
                        <th>Nomor Telepon Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(supplier,index) in filteredList" :key ="supplier.id">
                        <td>{{ supplier.nama_supplier }}</td>
                        <td>{{ supplier.sales_supplier }}</td>
                        <td>{{ supplier.no_telp_supplier }}</td>
                        <td>{{ supplier.alamat_supplier }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editSupplier' ,params:{id: supplier.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(supplier.id,index,supplier.nama_supplier)">
                          <i class="fa fa-trash"></i>
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                   </div>     
                    <div class="card-footer">
                      <pagination class="card-footer-item"
                        :data="suppliersData" @pagination-change-page="getResults" :limit="4">
                        <span slot="prev-nav">&lt; Previous</span>
	                      <span slot="next-nav">Next &gt;</span>
                      </pagination>
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
        suppliers: [],
        suppliersData: {},
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    computed: {
       filteredList: function(){
         return this.suppliers.filter((supplier) => {
           return supplier.nama_supplier.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/suppliers?page=' + page)
        .then(function(resp){
          app.suppliers = resp.data.data;
          app.suppliersData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getHasilPencarian(page){
          
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/supplier/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.suppliers = resp.data.data;
          app.suppliersData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaSupplier){
          axios.delete('/api/supplier/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Supplier " + namaSupplier);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Supplier")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaSupplier){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Supplier " + namaSupplier + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaSupplier);
          }
        })  
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      }
    }
  }

</script>
