import Vue from 'vue';
import './bootstrap';
import App from './components/App';
import Vuetify from '../plugins/vuetify';
import router from './router';
import store from './store';
import filter from './filter/index';
import VeeValidate from 'vee-validate';

import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { ValidationProvider } from 'vee-validate';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = Vue;
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VeeValidate);
Vue.use(Toaster, {timeout: 5000});
//header footer
Vue.component('nav-block', require('./components/layouts/blocks/nav/index.vue').default);
Vue.component('sidebar-block', require('./components/layouts/blocks/nav/sidebar.vue').default);
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
Vue.component('create-modal', require('./components/layouts/menu/blocks/modals/CreateModal').default);
//modal
Vue.component('activity-modal', require('./components/layouts/menu/blocks/modals/Activity').default);
Vue.component('bdays-modal', require('./components/layouts/menu/blocks/modals/Birthday').default);
Vue.component('task-modal', require('./components/layouts/menu/blocks/modals/Task').default);
Vue.component('reminders-modal', require('./components/layouts/menu/blocks/modals/Reminders').default);

Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);
Vue.component('cell-month', require('./components/layouts/сell-сalendar/CellMonth').default);
Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
Vue.component('cell-week', require('./components/layouts/сell-сalendar/CellWeek').default);
Vue.component('cell-year',require('./components/layouts/сell-сalendar/CellYear').default);
Vue.component('hour-block',require('./components/layouts/сell-сalendar/blocks/Hour').default);
Vue.component('additional-events',require('./components/layouts/сell-сalendar/blocks/AdditionalEvents').default);
Vue.component('search',require('./components/layouts/menu/blocks/Search').default);
Vue.component('search-result',require('./components/layouts/menu/blocks/ResultSearch').default);
Vue.component('delete',require('./components/layouts/menu/blocks/modals/Delete').default);
Vue.component('ValidationProvider', ValidationProvider);
import VueFilterDateParse from '@vuejs-community/vue-filter-date-parse';
Vue.use(VueFilterDateParse);

//eventBus
Vue.prototype.$eventBus = new Vue();

const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    store,
    filter,
    render: h => h(App)
});

