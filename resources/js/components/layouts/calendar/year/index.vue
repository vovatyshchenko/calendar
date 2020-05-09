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
            <span class="days" v-if="week[day]">{{ week[day].date.getDate() }}</span>
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
    this.$store.dispatch('get_year_holidays');
    this.$store.dispatch('week_days');
    this.$store.dispatch('year_data', this.year);
  },
  computed: {
    data() {
      return this.$store.getters.get_year;
    },
    days() {
      return this.$store.getters.get_days;
    },
    year_holidays() {
      return this.$store.getters.year_holidays;
    },
  },
}
</script>

<style lang="scss" scoped>
  .main {
    max-width: 75%;
    margin: 0 auto;
  }
  .header {
    padding: 0.25em;
    display: flex;
    flex-shrink: 0;
    justify-content: space-between;
  }
  .title {
    padding-left: 30px;
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
  .days {
    font-size: 12px;
    font-weight: bold;
    line-height: 14px;
    color: #999999;
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
</style>
