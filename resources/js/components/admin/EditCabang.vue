<template>
    <div>
        <div class="form-group">
            <router-link to="/cabang" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Ubah Cabang</div>
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
                            <button class="button is-success">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.cabangId = id;
            axios.get('/api/cabang/' + id )
                .then(function (resp) {
                    app.cabang = resp.data;
                })
                .catch(function () {
                    alert("Tidak dapat memuat cabang")
                });
           
        },
        data: function () {
            return {
                cabangId: null,
                cabang: {
                    nama_cabang: '',
                    alamat_cabang: '',
                    no_telp_cabang: '',
                },
                
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newCabang = app.cabang;
                axios.put('/api/cabang/update/' + app.cabangId, newCabang)
                    .then(function (resp) {
                        app.$router.replace('/cabang');
                        alert("Berhasil mengubah Cabang");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal mengubah Cabang");
                    });
            }
        }
    }
</script>