<template>
    <div class="calendar-day">
        <span>{{holidayTextEventForDay}}</span>
        <div class="day-header" align="left">
            <div class="day-time-header"><span>Время</span></div>
            <div class="day-event-header"><span>Событие</span></div>
        </div>
        <div class="day-body">
            <div class="hour-block" v-for="n in 24" align="left">
                <div class="day-time"><span>{{n}}:00</span></div>
                <div class="day-events">
                    <div class="day-event" v-for="n in 3">
                        <span>text</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import holiday from '../../../../mixin/holiday'
    export default {
        mixins: [holiday],
        data: () => ({
            fullDate: 0
        }),
        computed: {

        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/day.scss";
</style>
