<template>
    <div>
        <div class="form-group">
            <router-link to="/role" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Tambah Role</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Role : </label>
                            <br>
                            <input type="text" v-model="role.nama_role" class="form-control">
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
                role: {
                    nama_role: '',
                   
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newRole = app.role;
                axios.post('/api/role/store', newRole)
                    .then(function (resp) {
                        app.$router.push({path: '/role'});
                        alert("Berhasil Menambah Role");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal Menambah Role");
                    });
            }
        }
    }
</script>