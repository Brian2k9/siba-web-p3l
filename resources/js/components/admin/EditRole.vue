<template>
    <div>
        <div class="form-group">
            <router-link to="/role" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Ubah Role</div>
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
            app.roleId = id;
            axios.get('/api/role/' + id )
                .then(function (resp) {
                    app.role = resp.data;
                })
                .catch(function () {
                    alert("Tidak dapat memuat role")
                });
           
        },
        data: function () {
            return {
                roleId: null,
                role: {
                    nama_role: '',
                   
                },
                
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newRole = app.role;
                axios.put('/api/role/update/' + app.roleId, newRole)
                    .then(function (resp) {
                        app.$router.replace('/role');
                        alert("Berhasil mengubah Role");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal mengubah role");
                    });
            }
        }
    }
</script>