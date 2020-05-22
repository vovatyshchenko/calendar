export default {
    state: {
        isSearched:false,
        searchEvent:[],
        lastSearched:[]
    },
    mutations: {
        setStatusSearched(state,payload)
        {
            state.isSearched = payload;
        },
        setSearchEvent(state,payload)
        {
            state.searchEvent = payload;
        }
    },
    actions:{
        searchEvents(context, event) {
            axios.post('/search', event)
                .then(response => {
                    context.commit('setStatusSearched', true);
                    context.commit('setSearchEvent', response.data);
                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
    },
    getters: {
        isSearched:state=>state.isSearched,
        searchEvent:state=>state.searchEvent,
    }
}
