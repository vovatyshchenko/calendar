export default {
    state: {
        holidays: {},
        year_holidays: {}
    },
    mutations: {
        set_holidays(state, payload) {
            state.holidays = payload;
        },
        set_year_holidays(state, payload) {
            state.year_holidays = payload;
        }
    },
    actions: {
        get_holidays({ commit }) {
            axios.get('/api/get-holidays')
            .then(responce => {
                commit('set_holidays', responce.data);
            })
            .catch(error => {
                commit('set_error', error.message);
            })
          },
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
        holidays: state => state.holidays,
        year_holidays: state => state.year_holidays
    }
}
