import Vue from 'vue';
import './bootstrap';
import App from './components/App';
import Vuetify from '../plugins/vuetify';
import router from './router';
import store from './store';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
window.Vue = Vue;

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
Vue.component('create-modal', require('./components/layouts/menu/blocks/CreateModal').default);
//modal
Vue.component('activity-modal', require('./components/layouts/menu/blocks/modals/Activity').default);

Vue.component('bdays-modal', require('./components/layouts/menu/blocks/modals/bdays').default);
Vue.component('tasks-modal', require('./components/layouts/menu/blocks/modals/tasks').default);
Vue.component('reminders-modal', require('./components/layouts/menu/blocks/modals/reminders').default);

Vue.component('calendar-month', require('./components/layouts/calendar/month/MonthIndex.vue').default);
Vue.component('cell-month', require('./components/layouts/сell-сalendar/CellMonth').default);
Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
Vue.component('cell-week', require('./components/layouts/сell-сalendar/CellWeek').default);
Vue.component('cell-year',require('./components/layouts/сell-сalendar/CellYear').default);
Vue.component('year',require('./components/layouts/calendar/year/Year').default);


import Toaster from 'v-toaster'

// You need a specific loader for CSS files like https://github.com/webpack/css-loader
import 'v-toaster/dist/v-toaster.css'

// optional set default imeout, the default is 10000 (10 seconds).
Vue.use(Toaster, {timeout: 5000})
import { ValidationProvider } from 'vee-validate';

Vue.component('ValidationProvider', ValidationProvider);;
Vue.filter('cutText', function (value, symbolsCount){
    return value.length > symbolsCount
        ? value.slice(0, symbolsCount - 3) + '...'
        : value;
})

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
const app = new Vue({
    el: '#app',
    vuetify: Vuetify,
    router,
    store,
    render: h => h(App)
});

