<template>
    <div>
        <div class="week-event-header week-header">
            <span>{{getDayWeek}}</span>
        </div>
        <div class="week-events hour-block" v-for="n in 24">
            <hour-block></hour-block>
        </div>
    </div>
</template>

<script>
    export default {
        props:['date'],
        data(){
            return{
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            }
        },
        computed: {
            getDayWeek() {
                let currentDate = this.date[0];
                let parseDate = currentDate.split("-");
                let dayNumber= new Date(parseDate[2], parseDate[1]-1, parseDate[0]).getDay();

                return this.days[dayNumber]+', '+parseDate[0];
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
