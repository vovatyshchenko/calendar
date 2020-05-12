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
        activityCreate ({ commit }, event){
            commit("set_processing", true);
            axios.post('/create-activity',event)
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
        taskCreate ({ commit }, event){
            commit("set_processing", true);
            axios.post('/create-task',event)
                .then(responce => {
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
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
