<template>
<div class="content" id="homeAdmin">  
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item">
        
        <router-link to= "/" class="button is-dark"> ATMA AUTO </router-link>
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
      <a class="navbar-link">
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
            <router-link to= "/supplier"  class="navbar-item">Supplier</router-link>
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
            <router-link to= "/detail_trans_jasa"  class="navbar-item">Detail Jasa Service</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/detail_trans_sparepart"  class="navbar-item">Detail Sparepart</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/trans_penjualan"  class="navbar-item">Transaksi Penjualan</router-link>
          </a>
      </div>
    </div>
      

      <a class="navbar-item">
        <i class="fas fa-clipboard-list"></i> &nbsp; Pemesanan
      </a>

      
        <a class="navbar-item">
          <i class="far fa-file-alt"></i> &nbsp; Laporan
        </a>

        
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
<a>
<img src="../../../../public/AA_Logo.png" v-bind:style="{ marginLeft: '60px', width: '85px', height: '80px' }">
</a>
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