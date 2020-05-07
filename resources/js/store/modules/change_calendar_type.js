export default {
    state: {
        current_route: null
    },
    mutations: {
        set_route(state, payload) {
            state.current_route = payload
        },
    },
    actions: {
        set_calendar_page({ commit }, route){
            if (route == '/') {
                commit('set_route', route);
            }
            else if (route == '/week') {
                commit('set_route', route);
            }
            else if (route == '/month') {
                commit('set_route', route);
            }
            else if (route == '/year') {
                commit('set_route', route);
            }
        }
    },
    getters: {
        calendar_route: (state)=>state.current_route,
    }
}