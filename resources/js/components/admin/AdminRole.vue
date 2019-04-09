<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_role" class="button is-success">Tambah Role</router-link>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Role</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Nama Role</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(role,index) in roles" :key="role.id">
                        <td>{{ role.nama_role }}</td>
                        <td>
                            <router-link :to="{name: 'editRole', params: {id: role.id}}" class="button is-warning">
                                Edit
                            </router-link>
                            <a href="#"
                               class="button is-danger"
                               v-on:click="deleteEntry(role.id, index)">
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
                roles: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/role')
                .then(function (resp) {
                    app.roles = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat role");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/role/' + id)
                        .then(function (resp) {
                            app.roles.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus role");
                        });
                }
            }
        }
    }
</script>