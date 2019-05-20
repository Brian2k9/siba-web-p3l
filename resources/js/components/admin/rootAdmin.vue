<template>
<div class="content" id="homeAdmin">  
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a>
      <img src="../../../../public/AA_Logo.png" v-bind:style="{ marginLeft: '60px', width: '65px', height: '60px' }">
   </a>
    <a class="navbar-item">
        
        <router-link to= "/" class="button is-dark"> SIBA </router-link>
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
   <div class="navbar-start">
    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link" id="keloladata">
        <i class="fas fa-database"></i> &nbsp; Kelola Data
      </a>
      
      <div class="navbar-dropdown">
          <a class="navbar-item">
            <router-link to= "/role"  class="navbar-item">Role</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/jasa_service"  class="navbar-item">Jasa Service</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/pegawai"  class="navbar-item">Pegawai</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/sparepart"  class="navbar-item">Sparepart</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/supplier"  class="navbar-item" id="supplier">Supplier</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/pelanggan"  class="navbar-item">Pelanggan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/kendaraan"  class="navbar-item">Kendaraan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/cabang"  class="navbar-item">Cabang</router-link>
          </a>
      </div>
    </div>
    
    <div class="navbar-item has-dropdown is-hoverable">
      <a class="navbar-link">
        <i class="fas fa-money-check-alt"></i> &nbsp; Transaksi
      </a>
      
      <div class="navbar-dropdown">
          <a class="navbar-item">
            <router-link to= "/trans_penjualan"  class="navbar-item">Transaksi Penjualan</router-link>
          </a>
      </div>
    </div>
      

    
      <a class="navbar-item">
        <router-link to= "/trans_pengadaan" class="button is-dark"><i class="fas fa-shipping-fast"></i> &nbsp; Pemesanan</router-link>
      </a>
    

        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link">
            <i class="fas fa-clipboard-list"></i> &nbsp; Laporan
          </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            <router-link to= "/laporan/pendapatan_bulanan"  class="navbar-item">Pendapatan Bulanan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/laporan/pengeluaran_bulanan"  class="navbar-item">Pengeluaran Bulanan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/laporan/sparepart_terlaris"  class="navbar-item">Sparepart Terlaris</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/laporan/jasa_service"  class="navbar-item">Jasa service permotor</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/laporan/sisa_stok_bulanan"  class="navbar-item">Sisa Stok bulanan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/laporan/pendapatan_tahunan"  class="navbar-item">Pendapatan Tahunan</router-link>
          </a>
        </div>
      </div>
        
     </div>
    
    
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          
          <a class="button is-light">
            Log Out
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

        <div id="appPage">
            <main class="pageContent">
            <transition name="fade">
            <router-view></router-view>
            </transition>
            </main>
        </div>
        <br>
        
        <footer class="footer">
        <div class="content has-text-centered">
          <p>
            <strong>Halaman Admin SIBA ©2019</strong> 
          </p>
        </div>
        </footer>
        
</div>

 
</template>

<script>

    export default{
    }
</script>

<style>
  
</style>