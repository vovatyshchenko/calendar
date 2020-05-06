import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import User from './modules/user';
import Display from './modules/display';
import Calendar from './modules/calendar';
import Holidays from './modules/holidays';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Common,
        User,
        Display,
        Calendar,
        Holidays
    }
});
