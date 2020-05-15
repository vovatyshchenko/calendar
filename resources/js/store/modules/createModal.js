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
            commit("setProcessing", true);
            axios.post('/create-activity',event)
            .then(responce => {
                if (responce.data.message) {
                    commit("setStatus", true);
                    dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
                }
                commit("clearError");
                commit("setProcessing", false);
            })
            .catch(error => {
                commit("setProcessing", false);
                commit("setStatus", false);
                commit("setError", error);
            })
        },
        taskCreate ({ commit,dispatch,getters }, event){
            commit("setProcessing", true);
            axios.post('/create-task',event)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setError", error);
                })
        },
        birthdayCreate ({ commit,dispatch,getters}, birthday){
            commit("setProcessing", true);
            axios.post('/create-birthday',birthday)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents',{date_start:getters.getStartDate,date_end:getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setStatus", false);
                    commit("setError", error);
                })
        },
    },
    getters: {
        getStatus: (state)=>state.status,
        getStartDate: (state)=>state.startDate,
        getEndDate: (state)=>state.endDate,
    }
}
