import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'beranda',
        component: () => import('@/components/LoginRegisterNav.vue'),
        children:[
            {
                path: '/login',
                name: 'login.index',
                component: () => import('@/components/IndexLayout.vue'),
            },
            {
                path: '/register',
                name: 'register.index',
                component: () => import('@/components/RegisterLayout.vue'),
            },
        ],
    },
    {
        path: "/dashboard",
        name: "dashboard.index",
        component: () => import('@/views/User/DashboardNav.vue'),
        children:[
            {
                path: "/layout",
                name: "dashboard.layout",
                component: () => import('@/views/User/DashboardLayout.vue')
            },
            {
                path: "/barang",
                name: "dashboard.barang",
                component: () => import('@/views/User/barang/DashboardBarang.vue')
            },
            {
                path: "/createBarang",
                name: "barang.create",
                component: () => import('@/views/User/barang/CreateBarang.vue')
            },
            {
                path: "/editBarang",
                name: "barang.edit",
                component: () => import('@/views/User/barang/EditBarang.vue')
            },
            {
                path: "/keranjang",
                name: "dashboard.keranjang",
                component: () => import('@/views/User/keranjang/DashboardKeranjang.vue')
            },
            {
                path: "/profil",
                name: "dashboard.profil",
                component: () => import('@/views/User/profil/DashboardProfil.vue')
            },
            {
                path: "/membership",
                name: "dashboard.membership",
                component: () => import('@/views/User/profil/CreateMembership.vue')
            }
        ]
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes 
})

export default router;