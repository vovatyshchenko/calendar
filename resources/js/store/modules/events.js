export default {
    state: {
        events: {},
        statusDelete: false,
        status: false,
        startDate: null,
        endDate: null,
        birthday: {
            name: null,
            date: moment(new Date()).format('YYYY-MM-DD'),
            time: '00:00',
            allDay: false,
            allYear: false,
            id: null,
        },
        isUpdateBirthday: false,
        isUpdateActive: false,
        isUpdateTask: false,
        activity: {
            name: null,
            dateStart: moment(new Date()).format('YYYY-MM-DD'),
            dateEnd: moment(new Date()).format('YYYY-MM-DD'),
            guests: null,
            location: null,
            timeStart: '00:00',
            timeEnd: '00:00',
            description: null,
            id: null,
        },
        task: {
            name: null,
            dateStart: moment(new Date()).format('YYYY-MM-DD'),
            dateEnd: moment(new Date()).format('YYYY-MM-DD'),
            timeStart: '00:00',
            timeEnd: '00:00',
            isRemind: false,
            about: null,
            id: null,
        },
        statusUpdated: false,
    },
    mutations: {
        setStatusDelete(state, payload) {
            state.statusDelete = payload;
        },
        setEvents(state, payload) {
            state.events = payload;
        },
        setIsUpdateBirthday(state, payload) {
            state.isUpdateBirthday = payload;
        },
        setIsUpdateActive(state, payload) {
            state.isUpdateActive = payload;
        },
        setIsUpdateTask(state, payload) {
            state.isUpdateTask = payload;
        },
        setStatus(state, payload) {
            state.status = payload
        },
        setStatusUpdated(state, payload) {
            state.statusUpdated = payload;
        },
        setStartDate(state, payload) {
            state.startDate = payload
        },
        setEndDate(state, payload) {
            state.endDate = payload
        },
        setTaskValues(state, payload) {
            state.task.name = payload.name,
                state.task.dateStart = payload.date_start,
                state.task.dateEnd = payload.date_end,
                state.task.about = payload.description,
                state.task.timeStart = payload.time_start,
                state.task.timeEnd = payload.time_end,
                state.task.isRemind = payload.is_remind,
                state.task.id = payload.id
        },
        setBirthdayValues(state, payload) {
            state.birthday.name = payload.name,
                state.birthday.date = payload.date,
                state.birthday.time = payload.time_start,
                state.birthday.allDay = payload.is_remind,
                state.birthday.allYear = payload.is_remind_year,
                state.birthday.id = payload.id
        },
        setActivityValues(state, payload) {
            state.activity.name = payload.name
            state.activity.dateStart = payload.date_start,
                state.activity.dateEnd = payload.date_end,
                state.activity.guests = payload.guests,
                state.activity.location = payload.location,
                state.activity.description = payload.description,
                state.activity.timeStart = payload.time_start,
                state.activity.timeEnd = payload.time_end,
                state.activity.id = payload.id
        },
    },
    actions: {
        getEvents(context, event) {
            axios.post('/events', event)
                .then(response => {

                    context.commit('setEvents', response.data);
                    context.commit("clearError");
                    context.commit("setProcessing", false);

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        deleteBirthdays(context, event) {
            axios.delete(`/delete-birthday/${event.event.id}`)
                .then(response => {
                    if (response.data.message) {
                        context.commit("setStatusDelete", true);
                        context.dispatch('getEvents', {
                            date_start: context.getters.getStartDate,
                            date_end: context.getters.getEndDate
                        })
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        deleteActivity(context, event) {

            axios.delete(`/delete-activity`, {data: event.event})
                .then(response => {
                    if (response.data.message) {
                        context.commit("setStatusDelete", true);
                        context.dispatch('getEvents', {
                            date_start: context.getters.getStartDate,
                            date_end: context.getters.getEndDate
                        })
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        deleteTask(context, event) {

            axios.delete(`/delete-task`, {data: event.event})
                .then(response => {
                    if (response.data.message) {
                        context.commit("setStatusDelete", true);
                        context.dispatch('getEvents', {
                            date_start: context.getters.getStartDate,
                            date_end: context.getters.getEndDate
                        })
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        getBirthday(context, id) {
            context.commit('setBirthdayValues', {});
            axios.get('/birthday/' + id)
                .then(response => {
                    context.commit('setBirthdayValues', response.data);
                    // context.dispatch('setContactValue');
                })
                .catch(error => {

                });
        },
        getActivity(context, id) {
            context.commit('setActivityValues', {});
            axios.get('/activity/' + id)
                .then(response => {
                    context.commit('setActivityValues', response.data);
                })
                .catch(error => {
                });
        },
        getTask(context, id) {
            context.commit('setTaskValues', {});
            axios.get('/task/' + id)
                .then(response => {
                    context.commit('setTaskValues', response.data);
                })
                .catch(error => {
                });
        },
        activityCreate({commit, dispatch, getters}, event) {
            commit("setProcessing", true);
            axios.post('/create-activity', event)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setStatus", false);
                    commit("setError", error.response.data.message);
                })
        },
        taskCreate({commit, dispatch, getters}, event) {
            commit("setProcessing", true);
            axios.post('/create-task', event)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setError", error);
                })
        },
        birthdayCreate({commit, dispatch, getters}, birthday) {
            commit("setProcessing", true);
            axios.post('/create-birthday', birthday)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatus", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
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
        birthdayUpdate({commit, dispatch, getters}, birthday) {
            commit("setProcessing", true);
            axios.put('/update-birthday', birthday)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatusUpdated", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setStatusUpdated", false);
                    commit("setError", error);
                })
        },
        activityUpdate({commit, dispatch, getters}, activity) {
            commit("setProcessing", true);
            axios.put('/update-activity', activity)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatusUpdated", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
                        if(getters.searchActive==true)
                        {
                            dispatch('searchEvents',getters.lastRequestSearched);
                        }
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setStatusUpdated", false);
                    commit("setError", error.response.data.message);
                })
        },
        taskUpdate({commit, dispatch, getters}, task) {
            commit("setProcessing", true);
            axios.put('/update-task', task)
                .then(responce => {
                    if (responce.data.message) {
                        commit("setStatusUpdated", true);
                        dispatch('getEvents', {date_start: getters.getStartDate, date_end: getters.getEndDate})
                    }
                    commit("clearError");
                    commit("setProcessing", false);
                })
                .catch(error => {
                    commit("setProcessing", false);
                    commit("setStatusUpdated", false);
                    commit("setError", error);
                })
        },
    },
    getters: {
        events: state => state.events,
        type: state => state.type,
        setStatusDelete: state => state.statusDelete,
        getStatus: (state) => state.status,
        getStartDate: (state) => state.startDate,
        getEndDate: (state) => state.endDate,
        getBirthday: (state) => state.birthday,
        getActivity: (state) => state.activity,
        getTask: (state) => state.task,
        isUpdateBirthday: (state) => state.isUpdateBirthday,
        isUpdateActive: (state) => state.isUpdateActive,
        // getBirthdayDate:(state)=>state.birthday.date,
        getStatusUpdated: state => state.statusUpdated,
        isUpdateTask: (state) => state.isUpdateTask
    }
}
