<template>
    <div>
        <div class="form-group">
            <router-link to="/sparepart" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Ubah Sparepart</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Kode Sparepart : </label>
                            <br>
                            <input type="text" v-model="sparepart.kode_sparepart" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Sparepart : </label>
                             <br>
                            <input type="text" v-model="sparepart.nama_sparepart" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Merk Sparepart : </label>
                            <br>
                            <input type="text" v-model="sparepart.merk_sparepart" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Tipe Sparepart : </label>
                            <br>
                            <input type="text" v-model="sparepart.tipe_sparepart" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Gambar Sparepart : </label>
                             <br>
                            <input type="file" @change="onFileSelected" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Jumlah Stok Sparepart : </label>
                             <br>
                            <input type="text" v-model="sparepart.jumlah_stok_sparepart" class="form-control">
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Harga Beli Sparepart : </label>
                            <br>
                            <input type="text" v-model="sparepart.harga_beli_sparepart" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Harga Jual Sparepart : </label>
                            <br>
                            <input type="text" v-model="sparepart.harga_jual_sparepart" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Jumlah Minimal : </label>
                            <br>
                            <input type="text" v-model="sparepart.jumlah_minimal" class="form-control">
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
            app.sparepartId = id;
            axios.get('/api/sparepart/' + id )
                .then(function (resp) {
                    app.sparepart = resp.data;
                })
                .catch(function () {
                    alert("Tidak dapat memuat sparepart")
                });
        },
        data: function () {
            return {
                sparepartId: null,
                sparepart: {
                    kode_sparepart: '',
                    nama_sparepart: '',
                    merk_sparepart: '',
                    tipe_sparepart: '',
                    gambar_sparepart: '',
                    jumlah_stok_sparepart: '',
                    harga_beli_sparepart: '',
                    harga_jual_sparepart: '',
                    jumlah_minimal: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newSparepart = app.sparepart;
                axios.put('/api/sparepart/update/' + app.sparepartId, newSparepart)
                    .then(function (resp) {
                        app.$router.replace('/sparepart');
                        alert("Berhasil mengubah Sparepart");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal mengubah Sparepart");
                    });
            },

            onFileSelected(e){
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
                this.sparepart.gambar_sparepart = e.target.result
            }
        },

            
        }
    }
</script>