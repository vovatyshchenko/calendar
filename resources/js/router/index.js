import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../components/layouts/Home';
import About from '../components/layouts/About';

const routes = [
    {
        component: Home,
        name: 'home',
        path: '/'
    },
    {
        component: About,
        name: 'about',
        path: '/about'
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});