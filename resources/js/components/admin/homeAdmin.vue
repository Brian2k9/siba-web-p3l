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
        Kelola Data
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
    
      

      <a class="navbar-item">
        Pemesanan
      </a>

      
        <a class="navbar-item">
          Laporan
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
<img src="../../../../public/AAlogo.png">
</a>
        <div id="appPage">
            <main class="pageContent">
            <transition name="fade">
            <router-view></router-view>
            </transition>
            </main>
        </div>
        <div class="footer">
            <p style="text-align: center">Halaman Admin SIBA</p>
        </div>
</div>

 
</template>

<script>

    export default{
    }
</script>

<style>
  .footer{
    background-color: silver;
    height: 100vh;
  }
  img{
    margin-left: 70px;
  }
</style>