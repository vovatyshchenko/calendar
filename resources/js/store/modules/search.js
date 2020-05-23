export default {
    state: {
        isSearched:false,
        searchActive:false,
        searchEvent:[],
        lastRequestSearched:[],

    },
    mutations: {
        setStatusSearched(state,payload)
        {
            state.isSearched = payload;
        },
        setSearchActive(state,payload)
        {
            state.searchActive = payload;
        },
        setSearchEvent(state,payload)
        {
            state.searchEvent = payload;
        },
        setLastRequestSearched(state,payload)
        {
            state.lastRequestSearched = payload;
        }
    },
    actions:{
        searchEvents(context, event) {
            // context.commit('')
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
        searchActive:state=>state.searchActive,
        searchEvent:state=>state.searchEvent,
    }
}
