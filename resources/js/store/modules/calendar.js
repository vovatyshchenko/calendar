export default {
    state: {
        data: null,
        days: null,
    },
    mutations: {
        setYear(state, payload) {
            state.data = payload;
        },
        setDays(state, payload) {
            state.days = payload;
        },
    },
    actions: {
        yearData({ commit, getters, dispatch }) {
            let year = getters.menuDate.getFullYear();

            //dispatch('getEvents',{date_start:moment({ year: year, month: 0, day: 1 }).format('YYYY-MM-DD'),date_end:moment({ year: year, month: 11, day: 31 }).format('YYYY-MM-DD')});
            //commit('setStartDate',moment({ year: year, month: 0, day: 1 }).format('YYYY-MM-DD'));
            //commit('setEndDate',moment({ year: year, month: 11, day: 31 }).format('YYYY-MM-DD'));

            let data = [];
            let holiday = '';
            let event = getters.events;
            let objLength = Object.keys(event).length;

            for (let m = 0; m < 12; m++) {
              let day = moment({ year: year, month: m, day: 1 });// формируем дату на первый день каждого месяца
              let daysInMonth = day.daysInMonth(); // количество дней в месяце
              // готовим объект месяца
              let month = { 
                title: day.format("MMMM"),
                weeks: {},
              };
              // итерируем по количеству дней в месяце
              for (let d = 0; d < daysInMonth; d++) {
                holiday = '';
                if (getters.holidays[m + 1]) { // проверяем есть ли праздник на текущий месяц (который итерируется)
                  if (getters.holidays[m + 1][d + 1]) { //+1 к месяцу и дню moment ведет нумерация с 0, а нам нужно с 1 так с api приходит
                    holiday = getters.holidays[m + 1][d + 1].localName;
                  }
                }
                // получаем и записываем наши мероприятия, напоминания, задачи, дни рождения  в календарь
                let nameActivity = [];
                let nameReminder = [];
                let nameTask = [];
                let nameBirthday = [];

                if (getters.events && objLength > 0) {
                  let currentDate = moment(year +'-'+ (m + 1) +'-'+ (d + 1)).format('YYYY-MM-DD');

                  if (event[currentDate]) {
                    for (let i = 0; i < event[currentDate].length; i++){

                      if (event[currentDate][i].type == 'activity') {
                        nameActivity.push(event[currentDate][i].name);
                      }

                      if (event[currentDate][i].type == 'reminder') {
                        nameReminder.push(event[currentDate][i].name);
                      }

                      if (event[currentDate][i].type == 'task') {
                        nameTask.push(event[currentDate][i].name);
                      }

                      if (event[currentDate][i].type == 'birthday') {
                        nameBirthday.push(event[currentDate][i].name);
                      }
                    }
                  }
                }
                let week = day.week();
                // moment считает последние дни декабря за первую неделю, но мне надо чтобы считалось за 53
                if (m === 11 && week === 1) {
                  week = 53
                }
                if (m === 0 && week === 53 || week === 52) {
                  week = 0
                }
                // если неделя еще не присутствует в месяце, то добавляем ее
                if (!month.weeks.hasOwnProperty(week)) {
                  month.weeks[week] = {}
                }
                // добавляем день, у weekday() нумерация с нуля, поэтому добавляю единицу - так будет удобнее
                month.weeks[week][day.weekday() + 1] = {
                  date: day.toDate(),
                  holiday: holiday,
                  events: {
                    activitys: nameActivity,
                    reminders: nameReminder,
                    tasks: nameTask,
                    birthdays: nameBirthday,
                  }
                };
                // итерируем день на единицу, moment мутирует исходное значение
                day.add(1, 'd');
              }
              // добавлям данные по месяцу в год
              data.push(month);
            }
            return commit('setYear', data);
          },
          weekDays({ commit }) { // дни недели
            let days = [];
            for(let i = 1; i<=7; i++) {
              days.push(moment().isoWeekday(i).format("dd"))
            }
            commit('setDays', days);
          },
    },
    getters: {
        getDays: (state)=>state.days, 
        getYear: (state)=>state.data,
    }
  }