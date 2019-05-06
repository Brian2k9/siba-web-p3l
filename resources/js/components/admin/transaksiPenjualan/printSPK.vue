<template>
    <div v-show="false" id="printMe">
            <div class="ma-3">              
                <div class="text-xs-center">                  
                    <p class="headline">ATMA AUTO</p>
                    <p class="" >MOTORCYCLE SPAREPARTS AND SERVICES</p>
                    <p class="">Jl. Babarsari No. 43 Yogyakarta 552181</p>
                    <p class="">Telp. (0274)487711</p>
                    <p class="">http://www.atmaauto.com</p>
                    <hr>
                    <br>
                    <p class="title">SURAT PERINTAH KERJA</p>                                       
                </div>
                <div class="text-xs-right">
                  <template v-for="data in transaksiPenjualan" :value="data.id">
                  <tr>
                  <p>{{data.created_at}} </p>
                  </tr>
                  </template>                  
                </div>
                <div class="text-xs-left">
                  <template v-for="data in transaksiPenjualan" :value="data.id">
                  <tr>
                  <p>{{data.id}} </p>
                  <p>Cust &nbsp; {{data.pelanggans.nama_pelanggan}} &emsp; Montir &nbsp; {{data.detail_trans_jasa.pegawais.nama_pegawai}} </p>
                  <p>Telepon &nbsp; {{data.pelanggans.no_telp_pelanggan}}</p>
                  <p>Motor &nbsp; {{data.no_plat_kendaraan}}</p>
                    </tr>
                  </template>                  
                                  
                </div>
                <div class="text-xs-center">                  
                    <hr>
                    <br>
                    <p class="title">SPAREPARTS</p>                                       
                </div>
                <div>
                   <table style="width:100%" border="bold">
                     <tr>
                      <th>Kode</th>
                      <th>Nama</th> 
                      <th>Merk</th>
                      <th>Jumlah</th>
                    </tr>
                    <template v-for="data in transaksiPenjualan" :value="data.id">
                      <tr>
                        <td>{{data.detail_trans_sparepart.spareparts.kode_sparepart}}</td>
                        <td>{{data.detail_trans_sparepart.spareparts.nama_sparepart}}</td>
                        <td>{{data.detail_trans_sparepart.spareparts.merk_sparepart}}</td>
                        <td>{{data.detail_trans_sparepart.jumlah_barang}}</td>
                      </tr>
                    </template>
                   </table>
                </div>
                <br><br>
                <div class="text-xs-center">                  
                    <hr>
                    <br>
                    <p class="title">SERVICE</p>                                       
                </div>
                <div>
                   <table style="width:100%" border="bold">
                     <tr>
                      <th>Kode</th>
                      <th>Nama</th> 
                      <th>Jumlah</th>
                    </tr>
                    <template v-for="data in transaksiPenjualan" :value="data.id">
                      <tr>
                        <td>{{data.detail_trans_jasa.jasa_services.id}}</td>
                        <td>{{data.detail_trans_jasa.jasa_services.nama_jasa}}</td>
                        <td>{{data.detail_trans_jasa.jumlah_jasa}}</td>
                      </tr>
                    </template>
                   </table>
                </div>
                <button class="button is-info" @click="print"></button>
            </div>
        </div>
</template>

<script>
  export default {
    data: function() {
      return {
        transaksiPenjualan: [],
        detail_trans_jasa: [],
        detail_trans_sparepart: [],
        jasa_services: [],
        pegawais: [],
        kendaraans: [],
        spareparts: [],
        pelanggans: [],
        transId : null,
        
        //message: ''
      }
    },
    mounted()  {
     var app = this;
     this.transId = this.$route.params.id;
     axios.get('/api/trans_penjualan/SPK/'+this.transId)
     .then((resp) => {
       this.transaksiPenjualan =  resp.data;
     })
     .catch((resp) => {
        alert("Gagal memuat transaksi");    
     });
     
     app.getDetailTransJasa();
     app.getDetailTransSparepart();
     app.getJasas();
     app.getPegawais();
     app.getKendaraans();
     app.getSpareparts();
     app.getPelanggans();
    },
    methods: {
      print() {
      this.$htmlToPaper('printMe');
      },
      getDetailTransJasa(){
        var app = this;
        axios.get('/api/trans_penjualan/detail_jasa' + '/all')
        .then(function(resp){
          app.detail_trans_jasa = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
       getDetailTransSparepart(){
        var app = this;
        axios.get('/api/trans_penjualan/detail_spare' + '/all')
        .then(function(resp){
          app.detail_trans_sparepart = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getJasas(){
        var app = this;
        axios.get('/api/jasa_service' + '/all')
        .then(function(resp){
          app.jasa_services = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getPegawais(){
        var app = this;
        axios.get('/api/pegawai' + '/all')
        .then(function(resp){
          app.pegawais = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getKendaraans(){
        var app = this;
        axios.get('/api/kendaraan' + '/all')
        .then(function(resp){
          app.kendaraans = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getSpareparts(){
        var app = this;
        axios.get('/api/sparepart' + '/all')
        .then(function(resp){
          app.spareparts = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      getPelanggans(){
        var app = this;
        axios.get('/api/pelanggan' + '/all')
        .then(function(resp){
          app.pelanggans = resp.data;
        })
        .catch(function(resp){
          console.log(resp);
        })
      },
      
    }
  }

</script>