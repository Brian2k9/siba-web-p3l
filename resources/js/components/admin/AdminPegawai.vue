<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_pegawai" class="button is-success">Tambah Pegawai</router-link>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Pegawai</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>ID Role</th>
                        <th>Nama Pegawai</th>
                        <th>Alamat Pegawai</th>
                        <th>No Telp Pegawai</th>
                        <th>Gaji Per Minggu</th>
                        <th>Password Pegawai</th>
                        <th>ID Cabang</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(pegawai,index) in pegawais" :key="pegawai.id">
                        <td>{{ pegawai.id_role }}</td>
                        <td>{{ pegawai.nama_pegawai }}</td>
                        <td>{{ pegawai.alamat_pegawai }}</td>
                        <td>{{ pegawai.no_telp_pegawai }}</td>
                        <td>{{ pegawai.gaji_perminggu }}</td>
                        <td>{{ pegawai.password_pegawai }}</td>
                        <td>{{ pegawai.id_cabang }}</td>
                        <td>
                            <router-link :to="{name: 'editPegawai', params: {id: pegawai.id}}" class="fa fa-edit blue">
                                Edit
                            </router-link>
                            <a href="#"
                               class="fa fa-trash red"
                               v-on:click="deleteEntry(pegawai.id, index)">
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
                pegawais: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/pegawai')
                .then(function (resp) {
                    app.pegawais = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat pegawai");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/pegawai/' + id)
                        .then(function (resp) {
                            app.pegawais.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus pegawai");
                        });
                }
            }
        }
    }
</script>