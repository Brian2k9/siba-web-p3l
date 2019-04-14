<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">List Cabang</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_cabang" class="button is-success">Tambah Cabang &nbsp; <i class="fas fa-user-plus fa-fw"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      Pencarian 
                      <input class = "input is-rounded" type="text" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th>Nama Cabang</th>
                        <th>Alamat Cabang</th>
                        <th>Nomor Telepon Cabang</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(cabang,index) in cabangs" :key ="cabang.id">
                        <td>{{ cabang.nama_cabang }}</td>
                        <td>{{ cabang.alamat_cabang }}</td>
                        <td>{{ cabang.no_telp_cabang }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editCabang' ,params:{id: cabang.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(cabang.id,index,cabang.nama_cabang)">
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
                        :data="cabangsData" @pagination-change-page="getResults" :limit="4">
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
        cabangs: [],
        cabangsData: {},
        pencarian: '',
        loading: true
      }
    },
    mounted()  {
     var app = this;
    app.getResults();
    },
    watch: {
       pencarian: function (q) {
          if (q != '') {
            this.getHasilPencarian()  
          }
          else {
            this.getResults()
          }
          
        }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/cabang?page=' + page)
        .then(function(resp){
          app.cabangs = resp.data.data;
          app.cabangsData = resp.data;
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
        axios.get('/api/cabang/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.cabangs = resp.data.data;
          app.cabangsData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaCabang){
          axios.delete('/api/cabang/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Cabang " + namaCabang);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Cabang")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaCabang){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Cabang " + namaCabang + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaCabang);
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
