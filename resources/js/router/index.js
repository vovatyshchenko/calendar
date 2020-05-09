import Vue from 'vue';
import VueRouter from 'vue-router';
import Store from '../store';

Vue.use(VueRouter);

import Home from '../components/layouts/Home';
import Login from '../components/layouts/auth/Login';
import Register from '../components/layouts/auth/Register';
import Year from '../components/layouts/Year';
import Day from '../components/layouts/Day';
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
        component: Register,
        name: 'register',
        path: '/register'
    },

    {
        component: Year,
        name: 'calendar-year',
        path: '/year'
    },
    {
        component: Day,
        name: 'calendar-day',
        path: '/day'
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
