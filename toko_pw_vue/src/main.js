import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

//icon
import 'bootstrap-icons/font/bootstrap-icons'

//import Bootstrap, Popper, jQuery
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'

window.axios = axios

axios.defaults.baseURL = 'http://localhost:8000/api'

const app = createApp(App)

//use vue router
app.use(router)

app.mount('#app')