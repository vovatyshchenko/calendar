export default {
    state: {
        event: {
            name: null,
            guests: null,
            location: null,
            description: null,
            timeStart: null,
            timeEnd: null,
        },
        bday: {
            name: null,
            description: null,
            time: null,
            allDay: null,
            everyYear: null,
        }
    },
    mutations: {
        setEvent(state, payload) {
            state.event.name = payload.name;
            state.event.guests = payload.guests;
            state.event.location = payload.location;
            state.event.description = payload.description;
            state.event.timeStart = payload.timeStart;
            state.event.timeEnd = payload.timeEnd;
        },
        setBday(state, payload) {
            state.bday.name = payload.name;
            state.bday.description = payload.description;
            state.bday.time = payload.time;
            state.bday.allDay = payload.allDay;
            state.bday.everyYear = payload.everyYear;
        },
    },
    actions: {
        //запись мероприятия в БД
        activityCreate ({ commit }, event){
            axios.post('/create-activity',event)
            .then(responce => {
                commit("clear_error");
                commit("set_processing", false);
            })
            .catch(error => {
                commit("set_processing", false);
                commit("set_error", error);
            })
        },
        taskCreate ({ commit }, event){
            axios.post('/create-task',event)
                .then(responce => {
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
                    commit("set_error", error);
                })
        },
        BirthdayCreate ({ commit }, event){
            axios.post('/create-birthday',event)
                .then(responce => {
                    commit("clear_error");
                    commit("set_processing", false);
                })
                .catch(error => {
                    commit("set_processing", false);
                    commit("set_error", error);
                })
        },
    },
    getters:{
        get_events: state => state.event,
    }
}
