import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import Display from './modules/display';
import Calendar from './modules/calendar';
import Holidays from './modules/holidays';
import ChangeCalendarType from './modules/changeCalendarType';
import CreateModal from './modules/createModal';
import Events from './modules/events';
import TypeColors from './modules/typeColors';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Holidays,
        Common,
        Display,
        Calendar,
        ChangeCalendarType,
        CreateModal,
        Events,
        TypeColors
    }
});
