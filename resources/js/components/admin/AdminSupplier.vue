<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_supplier" class="button is-success">Tambah Supplier</router-link>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Supplier</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>Sales Supplier</th>
                        <th>Nomor Telepon Supplier</th>
                        <th>Alamat Supplier</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(supplier,index) in suppliers" :key="supplier.id">
                        <td>{{ supplier.nama_supplier }}</td>
                        <td>{{ supplier.sales_supplier }}</td>
                        <td>{{ supplier.no_telp_supplier }}</td>
                        <td>{{ supplier.alamat_supplier }}</td>
                        <td>
                            <router-link :to="{name: 'editSupplier', params: {id: supplier.id}}" class="fa fa-edit blue">
                                Edit
                            </router-link>
                            <a href="#"
                               class="fa fa-trash red"
                               v-on:click="deleteEntry(supplier.id, index)">
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
                suppliers: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/suppliers')
                .then(function (resp) {
                    app.suppliers = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat supplier");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/supplier/' + id)
                        .then(function (resp) {
                            app.suppliers.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus supplier");
                        });
                }
            }
        }
    }
</script>