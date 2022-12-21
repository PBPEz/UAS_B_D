<template>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top: 50px;">
            <div class="col-md-5">
                <div class="card border-2 rounded shadow">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="https://media.istockphoto.com/id/1351091293/vector/account-login-line-icon-new-user-register.jpg?b=1&s=170667a&w=0&k=20&c=HCqQVw2mdXVqYYlI53prduqqxZvVWG9N2xQ8ZIR8K_U="
                            style="height: 200px;">
                        </div>
                        <hr>

                        <form @submit.prevent="register">
                            <div class="form-group mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" 
                                v-model="user.username"
                                placeholder="Masukkan Username">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" 
                                v-model="user.email"
                                placeholder="Masukkan Email">
                            </div>

                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Password</label>
                                <input type="password" class="form-control"
                                v-model="user.password"
                                placeholder="Masukkan Password">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Nomor Telepon</label>
                                <input type="number" class="form-control"
                                v-model="user.no_telepon"
                                placeholder="Masukkan Nomor Telepon">
                            </div>
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary">REGISTER</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

export default {
    setup() {
        const user = reactive({
            username: '',
            email: '',
            password: '',
            no_telepon: ''
        })

        //vue router
        const router = useRouter()

        function register() {
            let username = user.username
            let email = user.email
            let password = user.password
            let no_telepon = user.no_telepon

            
            axios.post('http://localhost:8000/api/register',{
                username: username,
                email: email,
                password: password,
                no_telepon: no_telepon
            }).then(() => {
                router.push({
                    name: 'login.index'
                })
            }).catch(error => {
                console.log(error.response.data)
            })
        }

        //return
        return {
            user,
            router,
            register
        }
    }
}
</script>

<style>
</style>