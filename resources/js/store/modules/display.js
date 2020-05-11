export default {
    state: {
        drawer: false,
        showModal: false,
        displayDate: new Date(),
        datepicker: new Date(),
        year:new Date().getFullYear(),
        currentWeek:[]
    },
    mutations: {
        changeDrawer(state) {
            state.drawer=!state.drawer;
        },
        changeShowModal(state) {
            state.showModal=!state.showModal;
            console.log(state.showModal);
        },
        setCurrentYear(state, date) {
            let currentDate=new Date(date);
            state.year=currentDate.getFullYear();
        },
        setDate(state, date) {
            state.displayDate=new Date(date);
        },
        setDatePicker(state, date) {
            state.datepicker=new Date(date);
        },
        setCurrentWeek(state,date)
        {
            state.currentWeek=date;
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
        datepicker (state) {
            return state.datepicker;
        },
        year(state){
            return state.year;
        },
        week(state){
            return state.currentWeek;
        }
    }
}
