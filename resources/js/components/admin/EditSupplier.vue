<template>
    <div>
        <div class="form-group">
            <router-link to="/supplier" class="button is-warning">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Ubah Supplier</div>
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
            app.supplierId = id;
            axios.get('/api/supplier/' + id )
                .then(function (resp) {
                    app.supplier = resp.data;
                })
                .catch(function () {
                    alert("Tidak dapat memuat supplier")
                });
           
        },
        data: function () {
            return {
                supplierId: null,
                supplier: {
                    nama_supplier: '',
                    sales_supplier: '',
                    no_telp_supplier: '',
                    alamat_supplier: '',
                },
                
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newSupplier = app.supplier;
                axios.put('/api/supplier/update/' + app.supplierId, newSupplier)
                    .then(function (resp) {
                        app.$router.replace('/supplier');
                        alert("Berhasil mengubah Supplier");
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Gagal mengubah Supplier");
                    });
            }
        }
    }
</script>