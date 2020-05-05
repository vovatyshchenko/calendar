export default {
    state: {
        holidays: {}
    },
    mutations: {
        set_holidays(state, payload) {
            state.holiday = payload;
        }
    },
    actions: {
        get_holidays({ commit }) {
            axios.get('/api/get-holidays')
            .then(responce => {
                commit("set_holidays", responce.data);
                console.log(responce.data);
            })
            .catch(error => {
                commit("set_error", error.message);
            })
          }
    },
    getters:{
        holidays: state => state.holidays
    }
}