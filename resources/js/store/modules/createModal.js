export default {
    state: {
        status: false,
    },
    mutations: {
        setStatus(state, payload) {
            state.status = payload
        },
    },
    actions: {
        activityCreate ({ commit,dispatch }, event){
            commit("set_processing", true);
            axios.post('/create-activity', event)
            .then(responce => {
                if (responce.data.message) {
                    commit("setStatus", true);
                    dispatch('getEvents',{date_start:'2020-04-27',date_end:'2020-05-31'})
                }
                commit("clear_error");
                commit("set_processing", false);
            })
            .catch(error => {
                commit("set_processing", false);
                commit("setStatus", false);
                commit("set_error", error);
            })
        },
        taskCreate ({ commit }, task){
            commit("set_processing", true);
            axios.post('/create-task', task)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                    }
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
                    commit("setStatus", false);
                    commit("set_error", error);
                })
        },
        birthdayCreate ({ commit }, bday){
            commit("set_processing", true);
            axios.post('/create-birthday',bday)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                    }
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
                    commit("setStatus", false);
                    commit("set_error", error);
                })
        },
    },
    getters: {
        getStatus: (state)=>state.status,
    }
}
