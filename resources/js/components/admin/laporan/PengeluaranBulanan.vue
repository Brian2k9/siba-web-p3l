<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                  <div class="card-tools">
                      
                      <h6 class="card-tools" id="tanggal"></h6>
                  </div>
                   <div id="printMe"> 
                      
                    <div class="center">               
                      
                      <img src="../../../../../public/AA_Logo.png" v-bind:style="{ marginLeft: '200px', width: '165px', height: '160px',float:'left' }">
                      <h1 class="headline">ATMA AUTO</h1>
                      <p class="hehe" >
                      MOTORCYCLE SPAREPARTS AND SERVICES<br>
                      Jl. Babarsari No. 43 Yogyakarta 552181<br>
                      Telp. (0274)487711<br>
                      http://www.atmaauto.com
                      </p>
                      
                      <hr>
                      <br>
                      <p class="title">LAPORAN PENGELUARAN BULANAN</p>                                       
                    </div> 
                    <div class="card-body table-responsive p-0">
                    
                    <br>
                    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth" >
                    <thead>
                        <th class="No-Row">No</th>
                        <th>Bulan</th>
                        <th>Jumlah Pengeluaran</th>
                        
                    </thead>
                    <tbody>
                      <tr v-for="(trans_pengadaan,index) in filteredList" :key ="trans_pengadaan.id">
                        <td>{{ index+1 }}</td>
                        <td>{{ trans_pengadaan.bulan }}</td>
                        <td>{{ trans_pengadaan.total_harga_pengadaan }}</td>
                      </tr>
                    </tbody>
                    </table>     
                    <vue-simple-spinner v-if="loading"></vue-simple-spinner>            
                  </div> 
                    <br>
                    <div>
                      <apexchart width="500" type="pie" :options="chartOptions" :series="series"></apexchart>
                    </div>
                    <br>
                    <div align="center">
                      <button class="button is-success" @click="print">Cetak</button>
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
        transaksiPengadaan: {},
        //transaksiPengadaanData: {},
        loading: true,
        series: [{
            values: this.transaksiPengadaanData
        }],
        chartOptions: {
          labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
          responsive: [{
            breakpoint: 480,
            options: {
              chart: {
                width: 200
              },
              legend: {
                position: 'bottom'
              }
            }
          }]
        }
        // series: [{
        //   name: 'series-1',
        //   data: [this.transaksiPenjualan]
        // }] 
      }
    },
    function :{
      timeNow(i) {
        var d = new Date(),
          h = (d.getHours()<10?'0':'') + d.getHours(),
          m = (d.getMinutes()<10?'0':'') + d.getMinutes();
        i.value = h + ':' + m;
      }
    },
    created() {
      var app = this;
      
    },
    mounted()  {
     var app = this;
    app.getResults();

    var jan = app.getGrandTotalChartData(0);

    console.log(jan);

    this.$nextTick(function() {
      window.chart = require('chart.js');

      var ctx = document.getElementById("myChart").getContext("2d");

var data = {
  labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
  datasets: [{
    label: "Service",
    backgroundColor: "blue",
    data: [3, 4, 5, 3, 9, 7, 8, 4, 8, 3, 5, 1] //data nya urutan dari jan sampe des
  }, {
    label: "Spareparts",
    backgroundColor: "red",
    data: [4, 3, 5, 5, 7, 3, 8, 5, 2, 6, 4, 9]
  }, {
    label: "Total",
    backgroundColor: "grey",
    data: [7, 2, 6, 6, 2, 4, 8, 6, 4, 6, 9, 3]
  }]
};

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
  	legend: {
    	position: 'right'
    },
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
        }
      }]
    }
  }
});

    })

    },
    computed: {
       filteredList: function(){
         return this.transaksiPengadaan;
       },
    //   series: function() {
    //   return [{
    //        //name: 'service',
    //        data: [1,2,3,4,5,6,7,8,9,10,11,12]
    //   }]
    //   },
      // chartOptions: function(){
      //   return{
      //       chartOptions: {
      //         chart: {
      //         id: 'vuechart-example'
      //         },
      //         xaxis: {
      //         categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus","September","Oktober","November","Desember"]
      //         }
      //       } 
      //   } 
      // },
    },
    methods: {
      getResults(){
        var app = this;
        axios.get('/api/report/pengeluaran_bulanan')
        .then(function(resp){
        app.transaksiPengadaan = resp.data;
        let transaksiPengadaanData = [];
        transaksiPengadaan.forEach(function(trans_pengadaan) {
        transaksiPengadaanData.push([parseFloat(trans_pengadaan.total_harga_pengadaan)]);
        });
        //this.total_harga_pengadaan = parseFloat(this.total_harga_pengadaan);
        //this.transaksiPenjualan = parseInt(this.transaksiPenjualan);
        app.loading = false;
        // console.log(app.transaksiPenjualan);
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      getGrandTotalChartData(month){
        var app = this;
        axios.get('/api/report/pendapatan_bulanan')
        .then(function(resp){
        app.grand_total_trans = resp.data[month].grand_total;
        app.loading = false;
        console.log(app.grand_total_trans);
        })
        .catch(function(resp){
          console.log(resp);
          app.loading = false;
         
        })
      },
      alert(title,pesan){
        this.$swal({
          title: title,
          text: pesan,
          icon: "success"
        });
      },
      print() {
        this.$htmlToPaper('printMe');
      },
    }
  }
  

</script>
