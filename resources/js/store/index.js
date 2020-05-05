import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import User from './modules/user';
import Display from './modules/display';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Common,
        User,
        Display
    }
});
