import Vue from 'vue';
import Vuex from 'vuex';

import CurrentUser from './modules/CurrentUser';
import Common from './modules/Common';
Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        CurrentUser,
        Common
    }
});