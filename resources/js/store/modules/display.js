export default {
    state: {
        drawer: false,
        showModal: false,
        displayDate: new Date(),
    },
    mutations: {
        change_drawer(state) {
            state.drawer=!state.drawer;
        },
        change_show_modal(state) {
            state.showModal=!state.showModal;
        },
        set_date(state, date) {
            state.displayDate=new Date(date);
        }
    },
    actions: {

    },
    getters:{
        drawer (state) {
            return state.drawer;
        },
        showModal(state) {
            return state.showModal;
        },
        menuDate (state) {
            return state.displayDate;
        },

    }
}
