<template>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <ul class="navbar-nav mx-auto">
                <button class="btn btn-outline-success m-2" 
                style="border-width: 2px;"
                type="button">
                    <router-link :to="{name: 'login.index'}" 
                    style="color: white;"
                    class="nav-link">Login</router-link>
                </button>
                <button class="btn btn-outline-success m-2" 
                style="border-width: 2px;"
                type="button">
                    <router-link :to="{name: 'register.index'}" 
                    style="color: white;"
                    class="nav-link">Register</router-link>
                </button>
            </ul>
        </div>
    </nav>
    <router-view></router-view>
</template>