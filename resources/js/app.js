import Vue from 'vue';
import './bootstrap';
import App from './components/App';
import Vuetify from '../plugins/vuetify';
import router from './router';
import store from './store';

window.Vue = Vue;

 //nav
 Vue.component('user-block', require('./components/layouts/blocks/nav/user.vue').default);
 Vue.component('footer-block', require('./components/layouts/blocks/footer/index.vue').default);
 //calrndars
 Vue.component('calendar-year', require('./components/layouts/calendar/year/index.vue').default);
 Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);
 Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
 Vue.component('calendar-day', require('./components/layouts/calendar/day/Day').default);
 //menu
 Vue.component('menu-calendar', require('./components/layouts/menu/Menu').default);
 Vue.component('sidebar-calendar', require('./components/layouts/menu/Sidebar').default);
 Vue.component('type-list', require('./components/layouts/menu/blocks/TypeList').default);
 Vue.component('mini-calendar', require('./components/layouts/menu/blocks/MiniCalendar').default);

 Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);
 Vue.component('cell-month', require('./components/CellCalendar/CellMonth').default);
 Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
 Vue.component('cell-week', require('./components/CellCalendar/CellWeek').default);
 Vue.component('cell-year',require('./components/CellCalendar/CellYear').default);
 Vue.component('year',require('./components/layouts/calendar/year/Year').default);
     
 Vue.component('cell-month', require('./components/CellCalendar/CellMonth').default);
 Vue.component('cell-week', require('./components/CellCalendar/CellWeek').default);

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    store,
    render: h => h(App)
});

