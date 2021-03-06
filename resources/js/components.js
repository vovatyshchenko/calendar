import Vue from 'vue';

export default {
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
    Vue.component('cell-month', require('./components/layouts/сell-сalendar/CellMonth').default);
    Vue.component('calendar-week', require('./components/layouts/calendar/week/WeekIndex').default);
    Vue.component('cell-week', require('./components/layouts/сell-сalendar/CellWeek').default);
    Vue.component('cell-year',require('./components/layouts/сell-сalendar/CellYear').default);
    Vue.component('year',require('./components/layouts/calendar/year/Year').default);

    Vue.component('cell-month', require('./components/layouts/сell-сalendar/CellMonth').default);
    Vue.component('cell-week', require('./components/layouts/сell-сalendar/CellWeek').default);
}
