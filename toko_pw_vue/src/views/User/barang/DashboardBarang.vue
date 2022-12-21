<template>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Barang</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                         <router-link :to="{ name: 'barang.create' }" class="btn btn-md btn-success">TAMBAH BARANG</router-link>
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">HARGA</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">DESKRIPSI</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="barang in barangs" :key="barang.id">
                                    <td>{{ barang.nama_barang }}</td>
                                    <td>{{ barang.harga }}</td>
                                    <td>{{ barang.jumlah }}</td>
                                    <td>{{ barang.deskripsi }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'barang.edit', params: { id: barang.id } }" 
                                        class="btn btn-sm btn-primary mr-1"><font-awesome-icon icon="fa-solid fa-pencil"/></router-link>
                                        <button @click.prevent="barangDelete(barang.id)"
                                            class="btn btn-sm btn-danger ml1"><font-awesome-icon icon="fa-solid fa-trash-can"/></button>
                                            // create item keranjang dari list barang
                                        <button @click.prevent="insertKeranjang(barang.id)" class="btn btn-sm btn-danger ml1">
                                            <font-awesome-icon icon="fa-solid fa-cart-plus" />
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
import { useRouter } from 'vue-router'

export default{
    data() {
        return {
            form: {
                nama_barang: '',
                harga: '',
                jumlah: '',
                deskripsi: ''
            },
            barangs: []
        }
    },
    mounted() {
        this.load()
        console.log("token" + useRouter().currentRoute.value.params.Token)    
    },
    methods: {
        async load() {
            try{
                const response = await axios.get("http://localhost:8000/api/barang", {
                    headers:{
                        Authorization: "Bearer ${token}",
                        token: localStorage.getItem("token")
                    }
                }, this.form)
                this.barangs = response.data
            }catch(e){
                console.log(e)
            }
        }
    }
}

// export default {
//     setup() {
//         //reactive state
//         let barangs = ref([])
//         //mounted
//         onMounted(() => {
//             //get API from Laravel Backend
//             axios.get('http://localhost:8000/Api/barang')
//                 .then(response => {
//                     //assign state posts with response data
//                     barangs.value = response.data.data
//                 }).catch(error => {
//                     console.log(error.response.data)
//                 })
//         })
//         function barangDelete(id) {
//             axios.delete(`http://localhost:8000/Api/barang/${id}`)
//                 .then(() => {
//                     barangs.value.splice(barangs.value.indexOf(id), 1);
//                 }).catch(error => {
//                     console.log(error.response.data)
//                 })
//         }
//         //return
//         return {
//             barangs,
//             barangDelete
//         }
//     }
// }
</script>
<style>

</style>