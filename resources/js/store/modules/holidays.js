export default {
    state: {
        holidays: []
    },
    mutations: {
        set_holidays(state, params) {

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
                        newResponse[month] =[];
                        // newResponse[month]['englishName'] = value.englishName;
                        // newResponse[month]['localName']= value.localName;
                    });
                    _.each(newResponse, function (value, index) {
                        _.each(response.data, function (dayValue,dayIndex) {
                            const month = response.data[dayIndex].date.month;
                            if(index==month)
                            {
                                let res={}
                                const day = response.data[dayIndex].date.day;

                                // newResponse[day] = response.data[index].date
                                // newResponse[day]['date']=response.data[index];
                                // newResponse[day]['englishName'] = value.englishName;
                                // newResponse[day]['localName']= value.localName;
                                // dayValue.date['localName']=dayValue.localName;
                                // dayValue.date['englishName']=dayValue.englishName;
                                res[day]=response.data[dayIndex].date;
                                res[day]['englishName'] = dayValue.englishName;
                                res[day]['localName']= dayValue.localName;
                                newResponse[index][dayValue.date.day]=res[day];
                            }

                        });

                    });
                    const params = {
                        data: newResponse,
                        // currentMonthKey: `${paramData.year}/${paramData.month}`,
                    }
                    context.commit("set_holidays", params);
                    // console.log(response.data);
                })
                .catch(error => {

                    context.commit("set_error", error.message);
                    console.log();
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
