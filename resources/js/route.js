import {createRouter, createWebHistory} from "vue-router";
import Login from "./components/Login.vue";
import Register from "./components/Register.vue";
import Main from "./components/Main.vue";
import PostEdit from "./components/PostEdit.vue";


//import help from "../pages/subPages/settings/help";


const route = [
    {
        path: '/',
        component: Main,
        name: 'home'
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/register',
        component: Register,
        name: 'register',

    },
    {
        path: '/post/edit/:id',
        component: PostEdit,
        name: 'postEdit',

    }

]

const router = createRouter({
    routes: route,
    history: createWebHistory()
})

export default router
