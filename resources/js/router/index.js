import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../components/layouts/Home';
import Year from '../components/layouts/Year';
import Day from '../components/layouts/Day';
import Week from '../components/layouts/Week';
import ResultSearch from '../components/layouts/menu/blocks/ResultSearch';
const routes = [
    {
        component: Home,
        name: 'home',
        path: '/',
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
    },
    {
        component: ResultSearch,
        name: 'search-result',
        path: '/search-result'
    },

];

export default new VueRouter({
    mode: 'history',
    routes
});
