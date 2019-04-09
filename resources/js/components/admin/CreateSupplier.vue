<template>
    <div>
        <div class="form-group">
            <router-link to="/supplier" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Tambah Supplier</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nama Supplier : </label>
                            <br>
                            <input type="text" v-model="supplier.nama_supplier" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Sales Supplier : </label>
                            <br>
                            <input type="text" v-model="supplier.sales_supplier" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Nomor Telepon Supplier : </label>
                            <br>
                            <input type="text" v-model="supplier.no_telp_supplier" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Alamat Supplier : </label>
                            <br>
                            <input type="text" v-model="supplier.alamat_supplier" class="form-control">
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
                supplier: {
                    nama_supplier: '',
                    sales_supplier: '',
                    no_telp_supplier: '',
                    alamat_supplier: '',
                }
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newSupplier = app.supplier;
                axios.post('/api/supplier/store', newSupplier)
                    .then(function (resp) {
                        app.$router.push({path: '/supplier'});
                        alert("Berhasil Menambah Supplier");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal Menambah Supplier");
                    });
            }
        }
    }
</script>