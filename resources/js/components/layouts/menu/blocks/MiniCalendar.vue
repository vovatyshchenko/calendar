<template>
    <div class="mini-calendar">
        <div class="mini-calendar-header">
            <button @click="prevMonth()" v-ripple>
                <v-icon>mdi-chevron-left</v-icon>
            </button>
            <span>{{months[monthIndex]}} {{year}}</span>
            <button @click="nextMonth()" v-ripple>
                <v-icon>mdi-chevron-right</v-icon>
            </button>
        </div>
        <div class="mini-calendar-body">
            <table>
                <thead>
                    <tr class="mini-calendar-dayname">
                        <td v-for="d in day">{{d}}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="week in getMonth" class="mini-calendar-day">
                        <td v-for="(day, index) in week" :class="{activeDay:activeDay(day)}" @click="changeActiveDate(day)" @dblclick="changeDay(day)">
                            <span :class="activeMonth(day)?'activeMonth':'noActiveMonth'">{{currentDate(day)}}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                day:["Пн", "Вт","Ср","Чт","Пт","Сб", "Вс"],
                page:0,
                monthIndex:0,
                months: ["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],
                year:0,
                noActive: false,
                activeDate: new Date
            }
        },
        methods:{
            prevMonth() {
                let currentDate = this.$store.getters.datepicker;
                currentDate.setMonth(currentDate.getMonth()-1);
                this.$store.commit('setDatePicker', currentDate);
            },
            nextMonth() {
                let currentDate = this.$store.getters.datepicker;
                currentDate.setMonth(currentDate.getMonth()+1);
                this.$store.commit('setDatePicker', currentDate);
            },
            changeActiveDate(date) {
                let parseDate = date.split("-");
                let fullDate=new Date(parseDate[2], parseDate[1]-1, parseDate[0]);
                this.$store.commit('setDatePicker', fullDate);
                this.$store.commit('setDate', this.$store.getters.datepicker);

                // if (window.location.pathname == '/day'){
                //     let formatCurrentDate = moment(parseDate[2]+'-'+parseDate[1]+'-'+parseDate[0]).format('YYYY-MM-DD');
                //     this.$store.dispatch('getEvents',{date_start:formatCurrentDate, date_end:formatCurrentDate});
                // }
            },
            changeDay(date) {
                let parseDate = date.split("-");
                let fullDate=new Date(parseDate[2], parseDate[1]-1, parseDate[0]);
                this.$store.commit('setDatePicker', fullDate);
                this.$store.commit('setDate', this.$store.getters.datepicker);

                // let formatCurrentDate = moment(parseDate[2]+'-'+parseDate[1]+'-'+parseDate[0]).format('YYYY-MM-DD');
                // this.$store.dispatch('getEvents',{date_start:formatCurrentDate, date_end:formatCurrentDate});

                if (window.location.pathname != '/day'){
                    this.$eventBus.$emit('currentRoute', '/day');
                    this.$store.commit('set_route', '/day');
                }
            },
            currentDate(date){
                let parseDate = date.split("-");
                return parseDate[0];
            },
            activeMonth(date){
                let currentMonth = this.$store.getters.datepicker.getMonth();
                let parseDate = date.split("-");
                if (parseDate[1]==currentMonth+1) {
                    return true;
                } else {
                    return false;
                }
            },
            activeDay(date){
                let today = new Date();
                let parseDate = date.split("-");
                if (today.getDate()==parseDate[0] && today.getMonth()==parseDate[1]-1 && today.getFullYear()==parseDate[2]) {
                    return true;
                } else {
                    return false;
                }
            },
        },
        computed:{
            getMonth() {
                let week = [];
                let monthDividedIntoWeeks = [];
                let counter = 0;
                this.monthIndex = this.$store.getters.datepicker.getMonth();
                this.year = this.$store.getters.datepicker.getFullYear();
                let nowDate=new Date(this.$store.getters.datepicker);
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

                                week.push(currentDay + "-" + currentMonth + "-" + currentYear);
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

                    week.push(currentDay + "-" + currentMonth + "-" + currentYear)
                    if (i % 7 == 0) {
                        monthDividedIntoWeeks.push(week);
                        week = [];
                        counter++;
                    }
                }
                return monthDividedIntoWeeks;
            },
        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/mini_calendar.scss";
</style>
