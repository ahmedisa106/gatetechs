import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue';
import PostsVue from '../views/Posts/index.vue';
import CreatePostVue from '../views/Posts/create.vue';
import EditPostVue from '../views/Posts/edit.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL), routes: [{
        path: '/', name: 'home', component: HomeView
    }, {
        path: '/about', name: 'about', // route level code-splitting
        // this generates a separate chunk (About.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import('../views/AboutView.vue')
    }, {
        path: '/posts', name: 'posts', component: PostsVue
    }, {
        path: '/posts/create', name: 'postsCreateVue', component: CreatePostVue
    }, {
        path: '/posts/:id/edit', name: 'postsEditVue', component: EditPostVue
    },]
})

export default router
