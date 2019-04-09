<template>
    <div>
        <div class="form-group">
            <router-link to="/jasa_service" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Tambah Jasa Service</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Jasa : </label>
                            <input type="text" v-model="jasa.nama_jasa" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Harga Jasa : </label>
                            <input type="text" v-model="jasa.harga_jasa" class="form-control">
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
                jasa: {
                    nama_jasa: '',
                    harga_jasa: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newJasa = app.jasa;
                axios.post('/api/jasa_service/store', newJasa)
                    .then(function (resp) {
                        app.$router.push({path: '/jasa_service'});
                        alert("Berhasil Menambah Jasa Service");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal Menambah Jasa Service");
                    });
            }
        }
    }
</script>