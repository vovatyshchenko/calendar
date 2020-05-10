import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import Display from './modules/display';
import Calendar from './modules/calendar';
import Holidays from './modules/holidays';
import HolidaysYear from './modules/holidaysYear';
import ChangeCalendarType from './modules/changeCalendarType';
import CreateModal from './modules/createModal';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Holidays,
        HolidaysYear,
        Common,
        Display,
        Calendar,
        ChangeCalendarType,
        CreateModal
    }
});
