import Vue from 'vue';
import Vuex from 'vuex';

import Common from './modules/common';
import User from './modules/user';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        Common,
        User
    }
});