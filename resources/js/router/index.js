import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from '../store';

Vue.use(VueRouter);

import Home from '../components/layouts/Home';
import Login from '../components/layouts/auth/Login';
import Year from '../components/layouts/Year';
import Month from '../components/layouts/Month';
import Week from '../components/layouts/Week';

const routes = [
    {
        component: Home,
        name: 'home',
        path: '/',
        //beforeEnter: guard
    },
    {
        component: Login,
        name: 'login',
        path: '/login'
    },
    {
        component: Year,
        name: 'calendar-year',
        path: '/year'
    },
    {
        component: Month,
        name: 'calendar-month',
        path: '/month'
    },
    {
        component: Week,
        name: 'calendar-week',
        path: '/week'
    }

];

export default new VueRouter({
    mode: 'history',
    routes
});

// function guard(from, to, next) {
//     if (Store.getters.is_user_authenticated === true){
//       next()
//     }
//     else{
//       next('/login')
//     }
// }
