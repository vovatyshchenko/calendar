export default {
    state: {
        holidays: [],

    },
    mutations: {
        setHolidays(state, params) {
            state.holidays = params.data;
        }
    },
    actions: {
        get_holidays(context, paramData) {

            axios.post('/month/get-holidays', paramData)
                .then(response => {

                    let newResponse = {};
                    _.each(response.data, function (value, index) {
                        const month = response.data[index].date.month;
                        newResponse[month] = [];
                    });
                    _.each(newResponse, function (value, index) {
                        _.each(response.data, function (dayValue, dayIndex) {
                            const month = response.data[dayIndex].date.month;
                            if (index == month) {
                                let res = {}
                                const day = response.data[dayIndex].date.day;
                                res[day] = response.data[dayIndex].date;
                                res[day]['englishName'] = dayValue.englishName;
                                res[day]['localName'] = dayValue.localName;
                                newResponse[index][dayValue.date.day] = res[day];
                            }
                        });
                    });
                    const params = {
                        data: newResponse,
                    }
                    context.commit("setHolidays", params);
                })
                .catch(error => {
                    context.commit("set_error", error.message);
                })
        },
    },
    getters: {
        holidays: state => state.holidays,
    }

}
