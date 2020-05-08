export default {
    state: {
        drawer: false,
        displayDate: new Date()
    },
    mutations: {
        change_drawer(state) {
            state.drawer=!state.drawer;
        },
        set_date(state, date) {
            state.displayDate=date;
        }
    },
    actions: {

    },
    getters:{
        drawer (state) {
            return state.drawer;
        },
        menuDate (state) {
            return state.displayDate;
        }
    }
}
