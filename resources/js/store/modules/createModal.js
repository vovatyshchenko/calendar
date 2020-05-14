export default {
    state: {
        status: false,
        startDate:null,
        endDate:null
    },
    mutations: {
        setStatus(state, payload) {
            state.status = payload
        },
        setStartDate(state,payload)
        {
            state.startDate = payload
        },
        setEndDate(state,payload)
        {
            state.endDate = payload
        }
    },
    actions: {
        activityCreate ({ commit,dispatch,getters }, event){
            commit("set_processing", true);
            axios.post('/create-activity',event)
            .then(responce => {
                if (responce.data.message) {
                    commit("setStatus", true);
                    dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
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
        taskCreate ({ commit,dispatch,getters }, event){
            commit("set_processing", true);
            axios.post('/create-task',event)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
                    }
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
                    commit("set_error", error);
                })
        },
        birthdayCreate ({ commit,dispatch,getters}, birthday){
            commit("set_processing", true);
            axios.post('/create-birthday',birthday)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
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
        getStartDate: (state)=>state.startDate,
        getEndDate: (state)=>state.endDate,
    }
}
