<template>
    <div>
        <div class="form-group">
            <router-link to="/cabang" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Tambah Cabang</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Cabang : </label>
                            <br>
                            <input type="text" v-model="cabang.nama_cabang" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alamat Cabang : </label>
                            <br>
                            <input type="text" v-model="cabang.alamat_cabang" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nomor Telepon Cabang : </label>
                            <br>
                            <input type="text" v-model="cabang.no_telp_cabang" class="form-control">
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
                cabang: {
                    nama_cabang: '',
                    alamat_cabang: '',
                    no_telp_cabang: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newCabang = app.cabang;
                axios.post('/api/cabang/store', newCabang)
                    .then(function (resp) {
                        app.$router.push({path: '/cabang'});
                        alert("Berhasil Menambah Cabang");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal Menambah Cabang");
                    });
            }
        }
    }
</script>