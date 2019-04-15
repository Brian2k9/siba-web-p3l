<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">List Jasa Service</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_jasa" class="button is-success">Tambah Jasa Service &nbsp; <i class="fas fa-user-plus fa-fw"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th>Nama Jasa</th>
                        <th>Harga Jasa</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(jasa_service,index) in filteredList" :key ="jasa_service.id">
                        <td>{{ jasa_service.nama_jasa }}</td>
                        <td>{{ jasa_service.harga_jasa }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editJasaService' ,params:{id: jasa_service.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(jasa_service.id,index,jasa_service.nama_jasa)">
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
                        :data="jasaservicesData" @pagination-change-page="getResults" :limit="4">
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
        jasa_services: [],
        jasaservicesData: {},
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
         return this.jasa_services.filter((jasa_service) => {
           return jasa_service.nama_jasa.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/jasa_service?page=' + page)
        .then(function(resp){
          app.jasa_services = resp.data.data;
          app.jasaservicesData = resp.data;
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
        axios.get('/api/jasa_service/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.jasa_services = resp.data.data;
          app.jasaservicesData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaJasa){
          axios.delete('/api/jasa_service/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Jasa Service " + namaJasa);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Jasa Service")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaJasa){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Jasa Service " + namaJasa + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaJasa);
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
