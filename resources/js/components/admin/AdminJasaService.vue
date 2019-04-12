<template>
    <div>
        <br>
        <div class="form-group">
            <router-link to="/tambah_jasa" class="button is-success">Tambah Jasa Service</router-link> 
             
             <input type="text" placeholder="Cari Nama Service" v-model="search"><button class="button is-primary" @click.prevent="cariItu()">Cari Jasa Service</button> 
        </div>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">List Jasa Service</div>
            <div class="panel-body">
                <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                    <thead>
                    <tr>
                        <th>Nama Jasa</th>
                        <th>Harga Jasa</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>

                    
                    <tbody v-if="showSearch==true">
                    <tr v-for="(cari,index) in caris" :key="cari.id">
                        <td>{{ cari.nama_jasa }}</td>
                        <td>{{ cari.harga_jasa }}</td>
                        <td>
                            <router-link :to="{name: 'editJasaService', params: {id: cari.id}}" class="fa fa-edit blue">
                                Edit
                            </router-link>
                            <a href="#"
                               class="fa fa-trash red"
                               v-on:click="deleteEntry(cari.id, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>

                    
                    <tbody v-if="showSearch==false">
                    <tr v-for="(jasa_service,index) in jasa_services" :key="jasa_service.id">
                        <td>{{ jasa_service.nama_jasa }}</td>
                        <td>{{ jasa_service.harga_jasa }}</td>
                        <td>
                            <router-link :to="{name: 'editJasaService', params: {id: jasa_service.id}}" class="fa fa-edit blue">
                                Edit
                            </router-link>
                            <a href="#"
                               class="fa fa-trash red"
                               v-on:click="deleteEntry(jasa_service.id, index)">
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
                
                jasa_services: [],
                lookingItem:{
                        
                },
                showSearch: false,
                search: '',
                caris: [],
            }
        },
        mounted() {
            var app = this;

                axios.get('/api/jasa_service')
                .then(function (resp) {
                    app.jasa_services = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat jasa service");
                });
                
        },
        methods: {
            

            cariItu(){
                
                 axios.get('/api/jasa_service/search?q=' +this.search)
                 .then(res => res.json())
                 .then(res => {
                    this.caris = resp.data;
                    this.showSearch = true;
                    this.search = '';
                    //this.$forceUpdate();
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Tidak dapat memuat jasa service");
                });


            },


            deleteEntry(id, index) {
                if (confirm("Anda yakin ingin menghapus?")) {
                    var app = this;
                    axios.delete('/api/jasa_service/' + id)
                        .then(function (resp) {
                            app.jasa_services.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Tidak dapat menghapus jasa service");
                        });
                }
            }
        }
    }
</script>