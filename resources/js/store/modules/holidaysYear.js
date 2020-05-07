export default {
    state: {
        year_holidays: {}
    },
    mutations: {
        set_year_holidays(state, payload) {
            state.year_holidays = payload;
        }
    },
    actions: {
        get_year_holidays({ commit }) {
            axios.get('/api/get-year-holidays')
                .then(responce => {
                    commit('set_year_holidays', responce.data);
                })
                .catch(error => {
                    commit('set_error', error.message);
                })
        }
    },
    getters:{
        year_holidays: state => state.year_holidays
    }
}
