<template>
    <div class="card text-center">
        <div class="card-body">
            <h5 class="card-title"
                >User</h5>
                <img src="https://cdn-icons-png.flaticon.com/512/64/64572.png" alt="Avatar" class="avatar">
                <br>
                <br>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name"
                        v-model="user.username">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email"
                        v-model="user.email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password"
                        v-model="user.password">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Update Profile</button>
                </div>
        </div>
    </div>
    <br>
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Daftar Membership</h5>
                    <p class="card-text">Dapatkan keuntungan lebih dengan Membership kami</p>
                    <button class="btn btn-success">
                        <router-link :to="{name: 'dashboard.membership'}" 
                            style="color: white; width: max-content;"
                            class="nav-link">Daftar</router-link>
                    </button>
                </div>
            </div>
</template>
<script>
import axios from 'axios'

export default{
    data() {
        return{
            user: [
                {username: 'username'},
                {email: 'email'},
                {password: 'password'}
            ]
        }
    },
    mounted(){
        axios.get('http://localhost:8000/api/register').then((response) => {
            this.user = response.data.data
            console.log(response.data.data)
        })
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