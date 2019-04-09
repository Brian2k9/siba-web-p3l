<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_sparepart" class="button is-success">Tambah Sparepart</router-link>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Sparepart</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Kode Sparepart</th>
                        <th>Nama Sparepart</th>
                        <th>Merk Sparepart</th>
                        <th>Tipe Sparepart</th>
                        <th>Gambar Sparepart</th>
                        <th>Jumlah Stok Sparepart</th>
                        <th>Harga Beli Sparepart</th>
                        <th>Harga Jual Sparepart</th>
                        <th>Jumlah Minimal</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(sparepart,index) in spareparts" :key="sparepart.id">
                        <td>{{ sparepart.kode_sparepart }}</td>
                        <td>{{ sparepart.nama_sparepart }}</td>
                        <td>{{ sparepart.merk_sparepart }}</td>
                        <td>{{ sparepart.tipe_sparepart }}</td>
                        <td><img :src="'/images/sparepart/' + sparepart.gambar_sparepart" width="100px"></td>
                        <td>{{ sparepart.jumlah_stok_sparepart }}</td>
                        <td>{{ sparepart.harga_beli_sparepart }}</td>
                        <td>{{ sparepart.harga_jual_sparepart }}</td>
                        <td>{{ sparepart.jumlah_minimal }}</td>
                        <td>
                            <router-link :to="{name: 'editSparepart', params: {id: sparepart.id}}" class="button is-warning">
                                Edit
                            </router-link>
                            <a href="#"
                               class="button is-danger"
                               v-on:click="deleteEntry(sparepart.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                spareparts: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/sparepart')
                .then(function (resp) {
                    app.spareparts = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat sparepart");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/sparepart/' + id)
                        .then(function (resp) {
                            app.spareparts.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus sparepart");
                        });
                }
            }
        }
    }
</script>