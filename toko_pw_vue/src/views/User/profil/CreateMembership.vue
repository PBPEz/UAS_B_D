<template>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"><b>Membership</b></h5>
            <br>
            <form @submit.prevent="register">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name"
                        v-model="name">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email"
                        v-model="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="membership" class="col-sm-2 col-form-label">Jenis Membership</label>
                    <div class="col-sm-2">
                        <a class="btn btn-secondary dropdown-toggle" href="#" id="membership" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Pilih Membership
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Bronze</a></li>
                            <li><a class="dropdown-item" href="#">Silver</a></li>
                            <li><a class="dropdown-item" href="#">Gold</a></li>
                            <li><a class="dropdown-item" href="#">Platinum</a></li>
                        </ul>
                    </div>
                </div>
            </form>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

export default {
    setup() {
        const membership = reactive({
            jenis_membership: ''
        })

        const validation = ref([])
        const router = useRouter()

        function member() {
            let jenis_membership = membership.jenis_membership

            axios.post('http://localhost:8000/api/membership', {
                jenis_membership: jenis_membership
            }).then(() => {
                router.push({
                    name: 'dashboard.profil'
                })
            }).catch(error => {
                validation.value = error.response
                console.log(validation.value)
            })
        }
        
        return {
            membership,
            validation,
            router,
            member
        }
    }
}
</script>
<style>
.avatar {
    vertical-align: middle;
    width: 100px;
    height: 100px;
    border-radius: 50%;
}
</style>