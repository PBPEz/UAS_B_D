<template>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top: 20px;">
            <div class="col-md-6">
                <div class="card border-2 rounded shadow-lg p-1 mb-5">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="https://img.freepik.com/premium-vector/key-icon-comic-style-access-login-vector-cartoon-illustration-pictogram-password-key-business-concept-splash-effect_157943-5381.jpg"
                            style="height: 150px; ">
                        </div>
                        <hr color="white">
                        <form @submit.prevent="login()">
                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" 
                                v-model="user.email"
                                placeholder="Masukkan Email" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Password</label>
                                <input class="form-control"
                                v-model="user.password"
                                placeholder="Masukkan Password" type="password" required>
                            </div>
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary">LOGIN</button>
                            </div>
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
        const user = reactive({
            email: '',
            password: ''
        })

        //state validation
        const validation = ref([])

        //vue router
        const router = useRouter()

        function login() {
            let email = user.email
            let password = user.password

            axios.post('http://localhost:8000/api/login',{
                email: email,
                password: password
            }).then(() => {
                console.log('berhasil')
                router.push({
                    name: 'dashboard.layout',
                    // params: { Token: res.response.data.access_token}
                })
                
            }).catch(error => {
                validation.value = error.response
            })
        }

        //return
        return {
            user,
            validation,
            router,
            login
        }
    }
}
</script>

<style>
</style>