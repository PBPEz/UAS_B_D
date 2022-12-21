<template>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Keranjang Saya</h1>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <!-- <router-link :to="{ name: 'keranjang.create' }" class="btn btn-md btn-success">MASUKAN KE KERANJANG</router-link> -->
                        <table class="table table-striped table-bordered mt4">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">NAMA BARANG</th>
                                    <th scope="col">JUMLAH</th>
                                    <th scope="col">TOTAL HARGA</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(keranjang, id) in keranjangs" :key="id">
                                    <td>{{ keranjang.nama_barang }}</td>
                                    <td>{{ keranjang.jumlah }}</td>
                                    <td>{{ keranjang.total_harga }}</td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'keranjang.edit', params: { id: keranjang.id } }"
                                            class="btn btn-sm btn-primary mr-1">EDIT</router-link>
                                        <button @click.prevent="keranjangDelete(keranjang.id)"
                                            class="btn btn-sm btn-danger ml1">DELETE</button>
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
import { onMounted, ref } from 'vue'
export default {
    setup() {
        //reactive state
        let keranjangs = ref([])
        //mounted
        onMounted(() => {
            //get API from Laravel Backend
            axios.get('http://127.0.0.1:8000/api/keranjang')
                .then(response => {
                    //assign state posts with response data
                    keranjangs.value = response.data.data
                }).catch(error => {
                    console.log(error.response.data)
                })
        })
        function keranjangDelete(id) {
            axios.delete(`http://localhost:8000/api/keranjang/${id}`)
                .then(() => {
                    keranjangs.value.splice(keranjangs.value.indexOf(id), 1);
                }).catch(error => {
                    console.log(error.response.data)
                })
        }
        //return
        return {
            keranjangs,
            keranjangDelete
        }
    }
}
</script>
<style>

</style>