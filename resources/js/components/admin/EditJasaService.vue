<template>
    <div>
        <div class="form-group">
            <router-link to="/jasa_service" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Ubah Jasa Service</div>
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
            app.jasaId = id;
            axios.get('/api/jasa_service/' + id )
                .then(function (resp) {
                    app.jasa = resp.data;
                })
                .catch(function () {
                    alert("Tidak dapat memuat jasa service")
                });
           
        },
        data: function () {
            return {
                jasaId: null,
                jasa: {
                    nama_jasa: '',
                    harga_jasa: '',
                },
                
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newJasa = app.jasa;
                axios.put('/api/jasa_service/update/' + app.jasaId, newJasa)
                    .then(function (resp) {
                        app.$router.replace('/jasa_service');
                        alert("Berhasil mengubah Jasa Service");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal mengubah jasa service");
                    });
            }
        }
    }
</script>