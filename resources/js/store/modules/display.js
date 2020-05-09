export default {
    state: {
        drawer: false,
        showModal: false,
        displayDate: new Date(),
        year:new Date().getFullYear()
    },
    mutations: {
        change_drawer(state) {
            state.drawer=!state.drawer;
        },
        change_show_modal(state) {
            state.showModal=!state.showModal;
            console.log(state.showModal);
        },
        setCurrentYear(state, date) {
            let currentDate=new Date(date);
            state.year=currentDate.getFullYear();
        },
        set_date(state, date) {
            state.displayDate=new Date(date);
        },

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
        year(state){
            return state.year;
        }

    }
}
