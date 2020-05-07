export default {
    state: {
        holidays: []
    },
    mutations: {
        set_holidays(state, params) {

            state.holidays = params.data;
            console.log(state.holidays);
        }
    },
    actions: {
         get_holidays(context, paramData) {

             axios.post('/month/get-holidays', paramData)
                .then(response => {

                    let newResponse = {};

                    _.each(response.data, function (value, index) {
                        const day = response.data[index].date.day;
                        newResponse[day] = response.data[index].date


                        // newResponse[index]['date']=response.data[index];
                        newResponse[day]['englishName'] = value.englishName;
                        newResponse[day]['localName'] = value.localName;

                    });
                    // console.log(newResponse);

                    const params = {
                        data: newResponse,
                        currentMonthKey: `${paramData.year}/${paramData.month}`,
                    }
                    context.commit("set_holidays", params);
                    // console.log(response.data);
                })
                .catch(error => {

                    context.commit("set_error", error.message);
                })
        }

    },
    getters: {
        holidays: state => state.holidays,
        // holidays(state,currentMonth)
        // {
        //     return state.holidays[currentMonth];
        // }
    }

}
