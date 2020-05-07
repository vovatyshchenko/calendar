import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import User from './modules/user';
import Display from './modules/display';
import Calendar from './modules/calendar';
import Holidays from './modules/holidays';
import Change_calendar_type from './modules/change_calendar_type';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Holidays,
        Common,
        User,
        Display,
        Calendar,
        Change_calendar_type
    }
});
