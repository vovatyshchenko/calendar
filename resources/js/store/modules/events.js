export default {
    state: {
        events: {},
    },
    mutations: {
        setEvents(state, payload) {
            state.events = payload;
        },
        deleteContacts(state, payload) {
            state.events[payload.date].splice(0,1)
        }
    },
    actions: {
        //запись мероприятия в БД
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
                    // console.log(responce.data['activities']);
                    context.commit("clear_error");
                    context.commit("set_processing", false);

                })
                .catch(error => {
                    console.log(error);
                    context.commit("set_processing", false);
                    context.commit("set_error", error);
                })
        },
        deleteEvent(context, event) {
            context.commit('deleteContacts',event)
            axios.delete(`/delete-birthday/${event.id}`)
                .then(responce => {
                    if (responce.data.message) {
                        context.commit("setStatus", true);
                        context.commit('deleteContacts',event)
                    }
                    context.commit("clear_error");
                    context.commit("set_processing", false);
                })
                .catch(error => {
                    context.commit("set_processing", false);
                    context.commit("set_error", error);
                })
        }
    },
    getters: {
        events: state => state.events,
        type: state => state.type,
    }
}
