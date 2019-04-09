<template>
<div class="content" id="homeAdmin">  
<nav class="navbar is-dark" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item">
        <img src="../../../../public/AA_logo_2.png">
        <router-link to= "/" class="navbar-item"> ATMA AUTO </router-link>
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
            <router-link to= "/supplier"  class="navbar-item">Pelanggan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/supplier"  class="navbar-item">Kendaraan</router-link>
          </a>
          <a class="navbar-item">
            <router-link to= "/cabang"  class="navbar-item">Cabang</router-link>
          </a>
      </div>
    </div>
    
      

      <a class="navbar-item">
        Pemesanan
      </a>

      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Laporan
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item">
            About
          </a>
          <a class="navbar-item">
            Jobs
          </a>
          <a class="navbar-item">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
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
        <div class="footer">
            <hr>
            <p style="text-align: center">Halaman Admin</p>
        </div>
</div>

 
</template>

<script>

    export default{
    }
</script>