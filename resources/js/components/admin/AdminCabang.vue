<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_cabang" class="button is-success">Tambah Cabang</router-link>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Cabang</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Nama Cabang</th>
                        <th>Alamat Cabang</th>
                        <th>Nomor Telepon Cabang</th>
                       
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(cabang,index) in cabangs" :key="cabang.id">
                        <td>{{ cabang.nama_cabang }}</td>
                        <td>{{ cabang.alamat_cabang }}</td>
                        <td>{{ cabang.no_telp_cabang }}</td>
                        
                        <td>
                            <router-link :to="{name: 'editCabang', params: {id: cabang.id}}" class="fa fa-edit blue">
                                Edit
                            </router-link>
                            <a href="#"
                               class="fa fa-trash red"
                               v-on:click="deleteEntry(cabang.id, index)">
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
                cabangs: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/cabang')
                .then(function (resp) {
                    app.cabangs = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat cabang");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/cabang/' + id)
                        .then(function (resp) {
                            app.cabangs.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus cabang");
                        });
                }
            }
        }
    }
</script>