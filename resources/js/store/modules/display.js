export default {
    state: {
        drawer: false,
    },
    mutations: {
        change_drawer(state) {
            state.drawer=!state.drawer;
        }
    },
    actions: {

    },
    getters:{
        drawer (state) {
            return state.drawer;
        }
    }
}
