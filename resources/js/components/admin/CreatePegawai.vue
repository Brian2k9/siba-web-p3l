<template>
    <div>
        
        <div class="form-group">
            <router-link to="/pegawai" class="button is-warning">Back</router-link>
        </div>
        
        <div class="panel panel-default">
            <div class="panel-heading">Tambah Pegawai</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ID Role : </label>
                            <br>
                            <input type="text" v-model="pegawai.id_role" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Pegawai : </label>
                             <br>
                            <input type="text" v-model="pegawai.nama_pegawai" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alamat Pegawai : </label>
                            <br>
                            <input type="text" v-model="pegawai.alamat_pegawai" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">No Telp Pegawai : </label>
                            <br>
                            <input type="text" v-model="pegawai.no_telp_pegawai" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Gaji Per Minggu : </label>
                             <br>
                            <input type="text" v-model="pegawai.gaji_perminggu" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Password Pegawai : </label>
                             <br>
                            <input type="text" v-model="pegawai.password_pegawai" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ID Cabang : </label>
                            <br>
                            <input type="text" v-model="pegawai.id_cabang" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="button is-success">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                pegawai: {
                    id_role: '',
                    nama_pegawai: '',
                    alamat_pegawai: '',
                    no_telp_pegawai: '',
                    gaji_perminggu: '',
                    password_pegawai: '',
                    id_cabang: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newPegawai = app.pegawai;
                axios.post('/api/pegawai/store', newPegawai)
                    .then(function (resp) {
                        app.$router.push({path: '/pegawai'});
                        alert("Berhasil Menambah Pegawai");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal Menambah Pegawai");
                    });
            }
        }
    }
</script>