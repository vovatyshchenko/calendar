<template>
    <div>
        <div class="week-event-header week-header">
            <div>
                <span>{{getDayWeek}} </span>
                 <span class="event">{{holidayTextEvent}}</span>
            </div>

        </div>
        <div class="week-events hour-block" v-for="n in 24">
            <hour-block></hour-block>
        </div>

<!--        <exit-confirmation ref="modal" @checking="checking()"></exit-confirmation>-->


      
    </div>
</template>

<script>

    import holiday from '../../../mixin/holiday'
    export default {
        props:['date'],
        mixins: [holiday],

        data(){
            return{
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            }
        },
        computed: {
            getDayWeek() {
                let parseDate = this.date.split("-");
                let dayNumber= new Date(parseDate[2], parseDate[1]-1, parseDate[0]).getDay();
                return this.days[dayNumber]+', '+parseDate[0];
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
