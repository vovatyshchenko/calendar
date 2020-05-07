export default {
    state: {
        data: null,
        days: null,
    },
    mutations: {
        set_year(state, payload) {
            state.data = payload;
        },
        set_days(state, payload) {
            state.days = payload;
        },
    },
    actions: {
        year_data({ commit }, year) {
            let data = [];
            for (let m = 0; m < 12; m++) {
              let day = moment({ year: year, month: m, day: 1 });// формируем дату на первый день каждого месяца
              let days_in_month = day.daysInMonth(); // количество дней в месяце
              // готовим объект месяца
              let month = { 
                title: day.format("MMMM"),
                weeks: {},
              };
              // итерируем по количеству дней в месяце
              for (let d = 0; d < days_in_month; d++) {
                let week = day.week();
                // небольшой хак, момент считает
                // последние дни декабря за первую неделю,
                // но мне надо чтобы считалось за 53
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
                // добавляем день, у weekday() нумерация с нуля,
                // поэтому добавляю единицу, можно и не добавлять,
                // но так будет удобнее
                month.weeks[week][day.weekday() + 1] = {
                  date: day.toDate(),
                };
                // итерируем день на единицу, moment мутирует исходное значение
                day.add(1, 'd');
              }
              // добавлям данные по месяцу в год
              data.push(month);
            }
            return commit('set_year', data);
          },
          week_days({ commit }) { // дни недели
            let days = [];
            for(let i = 1; i<=7; i++) {
              days.push(moment().isoWeekday(i).format("dd"))
            }
            commit('set_days', days);
          },
    },
    getters: {
        get_days: (state)=>state.days, 
        get_year: (state)=>state.data
    }
  }