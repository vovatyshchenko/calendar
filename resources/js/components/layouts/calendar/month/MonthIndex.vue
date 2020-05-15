<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <td class="header" v-for="d in day">{{d}}</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="week in getMonth">
                <td v-for="(day, index) in week">
                    <cell-month  :date="day"></cell-month>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                day: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
                year: this.$store.getters.year,

            }
        },
        methods: {},
        computed: {
            getMonth() {
                let week = [];
                let monthDividedIntoWeeks = [];
                let counter = 0;
                let nowDate=new Date(this.$store.getters.menuDate);
                nowDate.setDate(1);
                if (nowDate.getDate() - nowDate.getDay() == 1) {
                    nowDate.setDate(nowDate.getDate() - 7);
                }
                nowDate.setDate(nowDate.getDate() - nowDate.getDay());
                for (let i = 1; ; i++) {

                    let parseDate = new Date(nowDate.setDate(nowDate.getDate() + 1))
                    let currentDay = parseDate.getDate();
                    let currentMonth = parseDate.getMonth() + 1;
                    let currentYear = parseDate.getFullYear();

                    if (currentDay == 1 && i > 7 && week.length > 0) {
                        if (week.length < 7) {
                            for (let day = week.length + 1; day <= 7; day++) {

                                week.push(currentYear + "-" + currentMonth + "-" +currentDay)
                                parseDate = new Date(nowDate.setDate(nowDate.getDate() + 1))
                                currentDay = parseDate.getDate();
                                currentMonth = parseDate.getMonth()+1;
                                currentYear = parseDate.getFullYear();
                            }
                        }

                        monthDividedIntoWeeks.push(week);
                        break;
                    } else if (currentDay == 1 && i > 7) {
                        break;
                    }

                    week.push(currentYear + "-" + currentMonth + "-" +currentDay)
                    if (i % 7 == 0) {
                        monthDividedIntoWeeks.push(week);
                        week = [];
                        counter++;
                    }
                }
                this.$store.commit('setStartDate',moment(monthDividedIntoWeeks[0][0]).format('YYYY-MM-DD'));
                this.$store.commit('setEndDate',moment(monthDividedIntoWeeks[monthDividedIntoWeeks.length-1][6]).format('YYYY-MM-DD'));
                return monthDividedIntoWeeks;
            },
        },
        created() {

            this.$store.dispatch('getEvents',{date_start:moment(this.getMonth[0][0]).format('YYYY-MM-DD'),date_end:moment(this.getMonth[this.getMonth.length-1][6]).format('YYYY-MM-DD')});
        }
    }
</script>

<style scoped>
    .header {
        max-width: 160px;
        min-height: 90px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 900;
        font-size: 12px;
        line-height: 90px;
        /* identical to box height, or 750% */

        text-align: center;
        letter-spacing: 1.5px;
        text-transform: uppercase;

        color: #B3B3B3;
    }

    .table th, .table td {
        padding: 0px;
    }

    .table {
        max-width: 1100px;
    }

    .table td {
        border: 2px solid #F5F5F5;
    }
</style>
