/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue';
import './bootstrap';
import App from './components/App';
import Vuetify from '../plugins/vuetify';
import router from './router';
import store from './store';

window.Vue = Vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('nav-block', require('./components/layouts/blocks/nav/index.vue').default);
Vue.component('footer-block', require('./components/layouts/blocks/footer/index.vue').default);

Vue.component('calendar-year', require('./components/layouts/calendar/year/index.vue').default);

Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);


Vue.component('calendar-day', require('./components/layouts/calendar/day/Day').default);

Vue.component('menu-calendar', require('./components/layouts/menu/Menu').default);
Vue.component('sidebar-calendar', require('./components/layouts/menu/Sidebar').default);
Vue.component('type-list', require('./components/layouts/menu/blocks/TypeList').default);
Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);
Vue.component('cell-month', require('./components/CellCalendar/CellMonth').default);
Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
Vue.component('cell-week', require('./components/CellCalendar/CellWeek').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    store,
    render: h => h(App)
});

