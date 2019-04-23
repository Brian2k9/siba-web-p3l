<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                  <div class="card-header">
                    <h3 class="card-header-title">List Pegawai</h3>
                  </div>
                  <div class="card-tools">
                      <router-link to="/tambah_pegawai" class="button is-success">Tambah Pegawai &nbsp; <i class="fas fa-user-plus fa-fw"></i></router-link>
                  </div>
                    
                    <div class="card-body table-responsive p-0">
                    
                    <div align="right">
                      <i class="fas fa-search"></i> 
                      <input class = "input is-rounded" type="text" placeholder="cari berdasarkan nama" v-bind:style="{width: '20%' }" v-model="pencarian" />
                    </div>
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                        <th>Role</th>
                        <th>Nama Pegawai</th>
                        <th>Alamat Pegawai</th>
                        <th>No Telp Pegawai</th>
                        <th>Gaji Per Minggu</th>
                        <th>Password Pegawai</th>
                        <th>Cabang</th>
                        <th>Modify</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(pegawai,index) in filteredList" :key ="pegawai.id">
                        <td>{{ pegawai.role.nama_role }}</td>
                        <td>{{ pegawai.nama_pegawai }}</td>
                        <td>{{ pegawai.alamat_pegawai }}</td>
                        <td>{{ pegawai.no_telp_pegawai }}</td>
                        <td>{{ pegawai.gaji_perminggu }}</td>
                        <td>{{ pegawai.password_pegawai }}</td>
                        <td>{{ pegawai.cabang.nama_cabang }}</td>
                        <td>
                        <router-link 
                          :to="{name:'editPegawai' ,params:{id: pegawai.id}}" 
                          class="button is-primary">
                          <i class="fa fa-edit"></i>
                       </router-link>
                        <button 
                          class="button is-danger" 
                          v-on:click="konfirmasiHapus(pegawai.id,index,pegawai.nama_pegawai)">
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
                        :data="pegawaisData" @pagination-change-page="getResults" :limit="4">
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
        pegawais: [],
        pegawaisData: {},
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
         return this.pegawais.filter((pegawai) => {
           return pegawai.nama_pegawai.toLowerCase().match(this.pencarian.toLowerCase());
         });
       }
    },
    methods: {
      getResults(page){
        var app = this;
        if(typeof page == 'undefined'){
          page = 1;
        }
        axios.get('/api/pegawai?page=' + page)
        .then(function(resp){
          app.pegawais = resp.data.data;
          app.pegawaisData = resp.data;
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
        axios.get('/api/pegawai/search?q='+app.pencarian+'&page=' + page)
        .then(function(resp){
          app.pegawais = resp.data.data;
          app.pegawaisData = resp.data;
          app.loading = false;
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      deleteEntry(id,index,namaPegawai){
          axios.delete('/api/pegawai/' + id)
          .then((resp) => {
            this.getResults();
            this.alert("Berhasil Menghapus","Berhasil Menghapus Pegawai " + namaPegawai);
          })
          .catch((resp) =>{
            alert("Gagal Menghapus Pegawai")
            console.log(resp);
          })
      },
      konfirmasiHapus(id,index,namaPegawai){
      
        this.$swal({
          title: "Yakin Ingin Menghapus Pegawai " + namaPegawai + "?",
          text: "Data yang di hapus tidak akan bisa di kembalikan lagi",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            this.deleteEntry(id,index,namaPegawai);
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
