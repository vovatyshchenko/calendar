export default {
    state: {
        events: {},
        statusDelete:false,
    },
    mutations: {
        setEvents(state, payload) {
            state.events = payload;
        },
        setStatusDelete(state, payload)
        {
            state.statusDelete = payload;
        }
    },
    actions: {
        getEvents(context, event) {
            axios.post('/events', event)
                .then(response => {
                    let monthsEvents = {};
                    _.each(response.data['birthdays'], function (value, key) {
                        const day = moment(key).format('YYYY-MM-DD');

                        _.each(value, function (val) {
                            const birthdayKey = `birthday-${val.id}`;
                            if (!_.has(monthsEvents, day)) {
                                monthsEvents[day] = {
                                    birthdayKey: val
                                }
                            } else {
                                monthsEvents[day][birthdayKey] = val;
                            }
                        })
                    });
                    _.each(response.data['tasks'], function (value, key) {
                        const day = moment(key).format('YYYY-MM-DD');

                        _.each(value, function (val) {
                            const taskKey = `task-${val.id}`;
                            if (!_.has(monthsEvents, day)) {
                                monthsEvents[day] = {
                                    taskKey: val
                                }
                            } else {
                                monthsEvents[day][taskKey] = val;
                            }
                        })
                    });
                    _.each(response.data['activities'], function (value, key) {
                        const day = moment(key).format('YYYY-MM-DD');
                        _.each(value, function (val) {
                            const activityKey = `activity-${val.id}`;
                            if (!_.has(monthsEvents, day)) {
                                monthsEvents[day] = {
                                    activityKey: val
                                }
                            } else {
                                monthsEvents[day][activityKey] = val;
                            }
                        })
                    });

                    let sortedMonthEvents = {}
                    _.each(monthsEvents, function (dayEvents, day) {
                        sortedMonthEvents[day] = _.sortBy(dayEvents, ['time_start']);
                    })
                    context.commit('setEvents', sortedMonthEvents);
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
                        context.dispatch('getEvents',{date_start:context.getters.getStartDate,date_end:context.getters.getEndDate})
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        deleteActivity(context, event) {

            axios.delete(`/delete-activity`,{data:event.event})
                .then(response => {
                    if (response.data.message) {
                        context.commit("setStatusDelete", true);
                        context.dispatch('getEvents',{date_start:context.getters.getStartDate,date_end:context.getters.getEndDate})
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        },
        deleteTask(context, event) {

            axios.delete(`/delete-task`,{data:event.event})
                .then(response => {
                    if (response.data.message) {
                        context.commit("setStatusDelete", true);
                        context.dispatch('getEvents',{date_start:context.getters.getStartDate,date_end:context.getters.getEndDate})
                    }
                    context.commit("clearError");

                })
                .catch(error => {
                    context.commit("setProcessing", false);
                    context.commit("setError", error);
                })
        }
    },
    getters: {
        events: state => state.events,
        type: state => state.type,
        setStatusDelete:state=>state.statusDelete
    }
}
