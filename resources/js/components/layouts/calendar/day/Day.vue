<template>
    <div class="calendar-day">
        {{currentDate}}
        <span>{{holidayTextEventForDay}}</span>
        <div class="day-birthdays">
            <span v-for="(birthday, index) in getBirthdays">
                <span v-if="index==0">{{birthday}}</span>
                <span class="birthday-name">{{birthday.name}}</span>
            </span>
        </div>

        <div class="day-header" align="left">
            <div class="day-time-header"><span>Время</span></div>
            <div class="day-event-header"><span>Событие</span></div>
        </div>
        <table  width="100%" class="table-day">
            <tr v-for="n in 24">
                <td class="day-time" valign="bottom"><span>{{n}}:00</span></td>
                <td class="day-event" v-for="event in showEvents(n)" :rowspan="event.time_length">
                       {{event.time_start}}-{{event.time_end}} {{event.name}}
                </td>
            </tr>
        </table>


<!--        <div class="day-body">-->
<!--            <div class="hour-block" v-for="n in 24" align="left">-->
<!--                <div class="day-time"><span>{{n}}:00</span></div>-->
<!--                <div class="day-events">-->
<!--                    <hour-block :event="showEvents(n)"></hour-block>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>
<script>
    import holiday from '../../../../mixin/holiday'
    export default {
        mixins: [holiday],
        data: () => ({
            fullDate: 0,
            events: 0,
        }),
        methods: {
            showEvents(count) {
                let hourEvents = [];
                let n = 0;
                if (this.events!=null) {
                    for (let i = 0; i < this.events.length; i++) {
                        if (this.events[i].type == 'task' || this.events[i].type == 'activity') {
                            let parseStart = this.events[i].time_start.split(":");
                            let parseEnd = this.events[i].time_end.split(":");
                            let hourStart = +parseStart[0];
                            let hourEnd = 0;
                            if (+parseEnd[1]>0) {
                                hourEnd = +parseEnd[0]+1;
                            } else {
                                hourEnd = +parseEnd[0];
                            }

                            if (hourStart==count-1) {
                                hourEvents[n] = this.events[i];
                                hourEvents[n].time_length = (hourEnd-hourStart);
                                n++;
                            }
                        }
                    }
                    if (hourEvents.length>0) {
                        return hourEvents;
                    }
                }
            }
        },
        computed: {
            getBirthdays() {
                let currentBirthdays = [];
                let n = 1;
                if (this.events!=null) {
                    for (let i = 0; i < this.events.length; i++) {
                        if (this.events[i].type == 'birthday') {
                            currentBirthdays[n] = this.events[i];
                            n++;
                        }
                    }
                    if (currentBirthdays!=null) {
                        currentBirthdays[0] = 'Сегодня День рождения у:';
                        return currentBirthdays;
                    }
                }
            },
            currentDate () {
                let currentDate = this.$store.getters.menuDate;
                let formatCurrentDate = moment(currentDate.getFullYear()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getDate()).format('YYYY-MM-DD');
                this.events = this.$store.getters.events[formatCurrentDate];
                if (this.events == null) {
                    //return "Null"
                } else {
                    let currentEvents = [];
                    let n = 0;
                    for (let i = 0; i < this.events.length; i++) {
                        if (this.events[i].type == 'task' || this.events[i].type == 'activity') {
                            currentEvents[n] = this.events[i];
                            n++;
                        }
                    }
                    // return currentEvents;
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/day.scss";
    .table-day {
        width: 730px;
    }
    .day-time {
        width: 62px;
        height: 60px;
        border-bottom: 3px solid #F5F5F5;
        color: #B3B3B3;
    }
    .day-event {

    }
    .table-day tr{
        height: 60px;
        border-bottom: 3px solid #F5F5F5;
    }
</style>
