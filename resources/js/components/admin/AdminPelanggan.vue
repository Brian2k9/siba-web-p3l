<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">List Pelanggan</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_pelanggan" class="button is-success">Tambah Pelanggan &nbsp; <i class="fas fa-user-plus fa-fw"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      Pencarian 
                      <input class = "input is-rounded" type="text" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th>Nama Pelanggan</th>
                        <th>Alamat Pelanggan</th>
                        <th>Nomor Telepon Pelanggan</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody v-if="pelanggans.length">
                      <tr v-for="(pelanggan,index) in pelanggans" :key ="pelanggan.id">
                        <td>{{ pelanggan.nama_pelanggan}}</td>
                        <td>{{ pelanggan.alamat_pelanggan}}</td>
                        <td>{{ pelanggan.no_telp_pelanggan}}</td>
                        <td>
                        <router-link 
                          :to="{name:'editPelanggan' ,params:{id: pelanggan.id}}" 
                          class="button is-primary">
                          Ubah &nbsp; <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(pelanggan.id,index,pelanggan.nama_pelanggan)">
                          Hapus &nbsp; <i class="fa fa-trash"></i>
                        </button>
                        </td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                   </div>     
                    <div class="card-footer">
                      <pagination class="card-footer-item"
                        :data="pelanggansData" @pagination-change-page="getResults" :limit="4">
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
        pelanggans: [],
        pelanggansData: {},
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
        axios.get('/api/pelanggan?page=' + page)
        .then(function(resp){
          app.pelanggans = resp.data.data;
          app.pelanggansData = resp.data;
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
        axios.get('/api/pelanggan/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.pelanggans = resp.data.data;
          app.pelanggansData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaPelanggan){
          axios.delete('/api/pelanggan/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Pelanggan " + namaPelanggan);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Pelanggan")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaPelanggan){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Pelanggan " + namaPelanggan + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaPelanggan);
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
