<template>
  <div class="main">
    <div class="year">
      <div class="month" v-for="month in data">
        <div class="title">{{ month.title }}</div>
        <div class="week">
          <div class="day" v-for="d in days">
            <span class="day__title">{{d}}</span>
          </div>
        </div>
        <div class="week" v-for="week in month.weeks">
          <div class="day" v-for="day in 7">
            <span
              :style="{'color': (haveHolliday(week[day].holiday) && activeHoliday.active)?activeHoliday.textColor:'#B3B3B3'}"
              v-if="week[day]"
              @dblclick="showHoliday(week[day].date)">
              {{ week[day].date.getDate() }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({ }),
  created() {
    this.$store.dispatch('weekDays');
    this.$store.dispatch('yearData', this.year);
  },
  methods: {
    haveHolliday(value) {
      if (value != '') {
        return true;
      } else {
        return false;
      }
    },
    haveEvents(value) {
      if (value.activitys.length !== 0 ||
        value.reminders.length !== 0 ||
        value.tasks.length !== 0 ||
        value.birthdays.length !== 0  ) {
        return true;
      } else {
        return false;
      }
    },
    showHoliday(date) {
      date = moment(date).format('YYYY-MM-DD');
      this.$store.commit('setDate', date);
      if (window.location.pathname != '/day') {
        this.$eventBus.$emit('currentRoute', '/day');
        this.$store.commit('set_route', '/day');
      }

    },
  },
  computed: {
    data() {
      return this.$store.getters.getYear;
    },
    days() {
      return this.$store.getters.getDays;
    },
      activeHoliday() {
          let holidays = {};
          holidays.active = this.$store.getters.typeColors[3].active;
          holidays.textColor = this.$store.getters.textColors[this.$store.getters.typeColors[3].color];

          return holidays;
      },
  },
}
</script>

<style lang="scss" scoped>
  .main {
    max-width: 75%;
    margin: 0 auto;
  }
  .title {
    margin-bottom: 10px;
    text-transform: capitalize;
    font-weight: 500;
    font-size: 14px;
    line-height: 60px;
    color: #666666;
    flex-grow: 1;
    flex-basis: 0;
    border-top: 1px solid #F5F5F5;
    border-bottom: 3px solid #F5F5F5;
  }
  .week {
    display: flex;
    padding: 0 40px 10px 10px;
  }
  .day {
    font-size: 12px;
    font-weight: bold;
    line-height: 14px;
    color: #999999;
  }
  .day:hover {
    cursor: pointer;
  }
  .holiday {
    font-size: 12px;
    font-weight: bold;
    line-height: 14px;
    color: red;
  }
  .day__title {
    font-weight: bold;
    font-size: 12px;
    line-height: 30px;
    letter-spacing: 1px;
    color: #808080;
  }
  .day {
    margin: 0.25em;
    flex-grow: 1;
    flex-basis: 0;
  }
  .year {
    display: flex;
    flex-wrap: wrap;
  }
  .month {
    background-color: #fff;
    border-radius: 6px;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
    margin: 0.02em;
    flex-grow: 1;
    flex-basis: 0;
  }
  .v-content__wrap {
    background-color: #f5f5f5 !important;
  }
</style>
