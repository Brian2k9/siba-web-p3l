import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import RootAdmin from '../components/admin/rootAdmin.vue'
import HomeAdmin from '../components/admin/homeAdmin.vue'

import AdminJasaService from '../components/admin/jasa service/AdminJasaService.vue'
import CreateJasaService from '../components/admin/jasa service/CreateJasaService.vue'
import EditJasaService from '../components/admin/jasa service/EditJasaService.vue'

import AdminPegawai from '../components/admin/pegawai/AdminPegawai.vue'
import CreatePegawai from '../components/admin/pegawai/CreatePegawai.vue'
import EditPegawai from '../components/admin/pegawai/EditPegawai.vue'

import AdminSparepart from '../components/admin/sparepart/AdminSparepart.vue'
import CreateSparepart from '../components/admin/sparepart/CreateSparepart.vue'
import EditSparepart from '../components/admin/sparepart/EditSparepart.vue'

import AdminSupplier from '../components/admin/supplier/AdminSupplier.vue'
import CreateSupplier from '../components/admin/supplier/CreateSupplier.vue'
import EditSupplier from '../components/admin/supplier/EditSupplier.vue'

import AdminRole from '../components/admin/role/AdminRole.vue'
import CreateRole from '../components/admin/role/CreateRole.vue'
import EditRole from '../components/admin/role/EditRole.vue'

import AdminCabang from '../components/admin/cabang/AdminCabang.vue'
import CreateCabang from '../components/admin/cabang/CreateCabang.vue'
import EditCabang from '../components/admin/cabang/EditCabang.vue'

import AdminPelanggan from '../components/admin/pelanggan/AdminPelanggan.vue'
import CreatePelanggan from '../components/admin/pelanggan/CreatePelanggan.vue'
import EditPelanggan from '../components/admin/pelanggan/EditPelanggan.vue'

import AdminKendaraan from '../components/admin/kendaraan/AdminKendaraan.vue'
import CreateKendaraan from '../components/admin/kendaraan/CreateKendaraan.vue'
import EditKendaraan from '../components/admin/kendaraan/EditKendaraan.vue'



const routes = [
    {
        path: '/',
        component: RootAdmin,
        children : [
            {
                path: '/',
                component: HomeAdmin,
            },

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

            {
                path:'/kendaraan',
                component: AdminKendaraan
            },
            {
                path:'/tambah_kendaraan',
                component: CreateKendaraan
            },
            {
                name: 'editKendaraan',
                path:'/edit_kendaraan',
                component: EditKendaraan
            },
           
            
        ]
    }
    
        
    
]

const router = new VueRouter({mode: 'history', routes: routes});
export default router