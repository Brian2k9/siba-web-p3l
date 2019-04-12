import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//const HomeAdmin = Vue.component('HomeAdmin',require('../components/admin/homeAdmin.vue'));
//const AdminJasaService = Vue.component('AdminJasaService',require('../components/admin/AdminJasaService.vue'));
import HomeAdmin from '../components/admin/homeAdmin.vue'

import AdminJasaService from '../components/admin/AdminJasaService.vue'
import CreateJasaService from '../components/admin/CreateJasaService.vue'
import EditJasaService from '../components/admin/EditJasaService.vue'

import AdminPegawai from '../components/admin/AdminPegawai.vue'
import CreatePegawai from '../components/admin/CreatePegawai.vue'
import EditPegawai from '../components/admin/EditPegawai.vue'

import AdminSparepart from '../components/admin/AdminSparepart.vue'
import CreateSparepart from '../components/admin/CreateSparepart.vue'
import EditSparepart from '../components/admin/EditSparepart.vue'

import AdminSupplier from '../components/admin/AdminSupplier.vue'
import CreateSupplier from '../components/admin/CreateSupplier.vue'
import EditSupplier from '../components/admin/EditSupplier.vue'

import AdminRole from '../components/admin/AdminRole.vue'
import CreateRole from '../components/admin/CreateRole.vue'
import EditRole from '../components/admin/EditRole.vue'

import AdminCabang from '../components/admin/AdminCabang.vue'
import CreateCabang from '../components/admin/CreateCabang.vue'
import EditCabang from '../components/admin/EditCabang.vue'

import AdminPelanggan from '../components/admin/AdminPelanggan.vue'
import CreatePelanggan from '../components/admin/CreatePelanggan.vue'
import EditPelanggan from '../components/admin/EditPelanggan.vue'



const routes = [
    {
        path: '/',
        component: HomeAdmin,
        children : [
            {
                path:'/jasa_service',
                component: AdminJasaService
            },
            {
                path:'/tambah_jasa',
                component: CreateJasaService
            },
            {
                name: 'editJasaService',
                path:'/edit_jasa',
                component: EditJasaService
            },
            
            {
                path:'/pegawai',
                component: AdminPegawai
            },
            {
                path:'/tambah_pegawai',
                component: CreatePegawai
            },
            {
                name: 'editPegawai',
                path:'/edit_pegawai',
                component: EditPegawai
            },

            {
                path:'/sparepart',
                component: AdminSparepart
            },
            {
                path:'/tambah_sparepart',
                component: CreateSparepart
            },
            {
                name: 'editSparepart',
                path:'/edit_sparepart',
                component: EditSparepart
            },

            {
                path:'/supplier',
                component: AdminSupplier
            },
            {
                path:'/tambah_supplier',
                component: CreateSupplier
            },
            {
                name: 'editSupplier',
                path:'/edit_supplier',
                component: EditSupplier
            },

            {
                path:'/role',
                component: AdminRole
            },
            {
                path:'/tambah_role',
                component: CreateRole
            },
            {
                name: 'editRole',
                path:'/edit_role',
                component: EditRole
            },

            {
                path:'/cabang',
                component: AdminCabang
            },
            {
                path:'/tambah_cabang',
                component: CreateCabang
            },
            {
                name: 'editCabang',
                path:'/edit_cabang',
                component: EditCabang
            },

            {
                path:'/pelanggan',
                component: AdminPelanggan
            },
            {
                path:'/tambah_pelanggan',
                component: CreatePelanggan
            },
            {
                name: 'editPelanggan',
                path:'/edit_pelanggan',
                component: EditPelanggan
            },
           
            
        ]
    }
    
        
    
]

const router = new VueRouter({mode: 'history', routes: routes});
export default router