<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <h4>TAMBAH POST</h4>
                        <hr>

                        <form @submit.prevent="store">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" v-model="barang.nama"
                                    placeholder="Masukkan Nama Barang">
                                <!-- validation -->
                                <div v-if="validation.nama" class="mt-2 alert alert-danger">
                                    {{ validation.nama[0] }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Harga Barang</label>
                                <input class="form-control" type="number" v-model="barang.harga"
                                    placeholder="Masukkan Harga Barang">
                                <!-- validation -->
                                <div v-if="validation.harga" class="mt-2 alert alert-danger">
                                    {{ validation.harga[0] }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Jumlah</label>
                                <input class="form-control" type="number" v-model="barang.jumlah"
                                    placeholder="Masukkan Jumlah">
                                <!-- validation -->
                                <div v-if="validation.jumlah" class="mt-2 alert alert-danger">
                                    {{ validation.jumlah[0] }}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" v-model="barang.deskripsi" placeholder="Masukkan Deskripsi">
                                <!-- validation -->
                                <div v-if="validation.deskripsi" class="mt-2 alert alert-danger">
                                    {{ validation.deskripsi[0] }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    setup() {
        //state barang
        const barang = reactive({
            nama: '',
            harga: '',
            jumlah: '',
            deskripsi: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        //method store
        function store() {
            let nama = barang.nama_barang
            let harga = barang.harga
            let jumlah = barang.jumlah
            let deskripsi = barang.deskripsi

            axios.post('http://localhost:8000/api/barangs', {
                nama: nama,
                harga: harga,
                jumlah: jumlah,
                deskripsi: deskripsi
            }).then(() => {
                //redirect ke post index
                router.push({
                    name: 'barang.index'
                })
            }).catch(error => {
                //assign state validation with error
                validation.value = error.response.data
            })
        }

        //return
        return {
            barang,
            validation,
            router,
            store
        }
    }
}
</script>

<style>

</style>
