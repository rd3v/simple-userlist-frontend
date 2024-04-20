import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const Home = require('./../pages/Home.vue').default;
import User from './../pages/User.vue';
import NotFound from './../pages/NotFound.vue';
import Profile from './../pages/Profile.vue';
import Register from './../pages/Register.vue';
import Edit from './../pages/Edit.vue';
import Upload from './../pages/Upload.vue';

const routes = [
    {
        name: 'home',
        path: '/home',
        component: Home
    },
    {
        name: 'user',
        path: '/user',
        component: User,
    },
    {
        name: 'user-create',
        path: '/user/create',
        component: Register,
        props: true,
    },
    {
        name: 'profile',
        path: '/user/:id',
        component: Profile,
        props: true
    },
    {
        name: 'upload',
        path: '/user/:id/upload',
        component: Upload,
        props: true
    },
    {
        name: 'user-edit',
        path: '/user/:id/edit',
        component: Edit,
        props: true
    },
    {
        path: '*',
        component: NotFound
    }
];

const router = new VueRouter({
    linkActiveClass: 'active',
    mode: 'history',
    routes
});

export default router;