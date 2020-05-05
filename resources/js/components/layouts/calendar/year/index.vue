  <template>
  <div>
    <div class="header">
      <button @click="--year">&lt;--</button>
      <div class="title">{{ year }}</div>
      <button @click="++year">--&gt;</button>
    </div>
    <div class="year">
      <div class="month" v-for="month in yearData">
        <div class="title">{{ month.title }}</div>
        <div class="week">
          <div class="day" v-for="d in weekDays">
            <span>{{d}}</span>
          </div>
        </div>
        <div class="week" v-for="week in month.weeks">
          <div class="day" v-for="day in 7">
            <span v-if="week[day]">{{ week[day].date.getDate() }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    year: (new Date()).getFullYear()
  }),
  computed: {
    yearData() {
     let data = [];
     for (let m = 0; m < 12; m++) {
       let day = moment({year: this.year, month: m, day: 1});// формируем дату на первый день каждого месяца
       let daysInMonth = day.daysInMonth(); // количество дней в месяце
       // готовим объект месяца
       let month = {
         title: day.format("MMMM"),
         weeks: {},
       };
       // итерируем по количеству дней в месяце
       for (let d = 0; d < daysInMonth; d++) {
         let week = day.week();
         // небольшой хак, момент считает
         // последние дни декабря за первую неделю,
         // но мне надо чтобы считалось за 53
         // if (m === 11 && week === 1) {
         //   week = 53
         // }
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
     return data
   },
    weekDays () { // дни недели
      let days = [];
      for(let i = 1; i<=7;i++) {
        days.push(moment().isoWeekday(i).format("dd"))
      }
      return days;
    },
 }
}
</script>

<style lang="scss" scoped>
  @mixin font-style {
    font-style: normal;
    letter-spacing: 1px;
  }
  .header {
    padding: 0.25em;
    display: flex;
    flex-shrink: 0;
    justify-content: space-between;
  }
  .title {
    padding: 0 30px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
  }
  .week {
    display: flex;
    span {
      @include font-style;
      line-height: 14px;
      color: #808080;
    }
  }
  .day {
    margin: 0.25em;
    flex-grow: 1;
    flex-basis: 0;
    @include font-style;
    font-weight: bold;
    font-size: 12px;
    line-height: 14px;
    color: #999999;
    padding: 7px 0;
  }
  .year {
    display: flex;
    flex-wrap: wrap;
  }
  .month {
    @include font-style;
    font-weight: 500;
    font-size: 14px;
    line-height: 60px;
    color: #666666;
    margin: 0.25em;
    flex-grow: 1;
    flex-basis: 0;
    border-radius: 6px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
  }
</style>
