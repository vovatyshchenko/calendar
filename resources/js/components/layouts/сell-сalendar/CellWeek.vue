<template>
    <div>
        <div class="week-event-header week-header">
            <div>
                <span>{{getDayWeek}} </span>
                <span class="event">{{holidayTextEvent}}</span>
            </div>
        </div>
        <table>
            <tr class="week-events hour-block" v-for="n in 24">
                <td class="event-block" v-for="(event, index) in getEvent(events, date, n)" :key="index" :rowspan="event.time_length">{{ event.name }}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    import holiday from '../../../mixin/holiday'

    export default {
        props: ['date', 'events'],
        mixins: [holiday],
        data() {
            return {
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            }
        },
        computed: {
            getDayWeek() {
                let parseDate = this.date.split("-");
                let dayNumber = new Date(parseDate[0], parseDate[1] - 1, parseDate[2]).getDay();
                return this.days[dayNumber] + ', ' + parseDate[2];
            },
        },
        methods: {
            getEvent(obj, date, count) {
                let objCurrentData = [];
                let hourEvents = [];
                let n = 0;
                    for (let i = 0; i < obj.length; i++) {
                        if (obj[i].type == 'activity' || (obj[i].type == 'task') || obj[i].type == 'reminder') {
                            let dateStart = moment(obj[i].date_start);
                            let dateEnd = moment(obj[i].date_end);
                            let dateDiff = dateEnd.diff(dateStart, 'days');
                            for (let d = 0; d <= dateDiff; d++) {
                                if ((moment(obj[i].date_start).add(d, 'days')).isSame(date)) {
                                    objCurrentData.push(obj[i]);
                                }
                            }
                        }
                        if (obj[i].type == 'birthday') {
                            if (moment(obj[i].date).isSame(date)) {
                                objCurrentData.push(obj[i]);
                            }
                        }
                    }
                    for(let i = 0; i < objCurrentData.length; i++){
                        for(let j = i + 1; j < objCurrentData.length; j++){
                            if(objCurrentData[i].created_at == objCurrentData[j].created_at){
                                objCurrentData.splice(j--, 1);
                            }
                        }
                    }
                    if (objCurrentData.length > 0) {
                        for (let i = 0; i < objCurrentData.length; i++) {
                            if (objCurrentData[i].type == 'task' || objCurrentData[i].type == 'activity' || objCurrentData[i].type == 'birthday') {
                                let parseStart = objCurrentData[i].time_start.split(":");
                                let parseEnd = objCurrentData[i].time_end.split(":");
                                let hourStart = +parseStart[0];
                                let hourEnd = 0;
                                if (+parseEnd[1] > 0) {
                                    hourEnd = +parseEnd[0] + 1;
                                } else {
                                    hourEnd = +parseEnd[0];
                                }

                                if (hourStart == count - 1) {
                                    hourEvents.push(objCurrentData[i]);
                                    hourEvents[n].time_length = (hourEnd-hourStart);
                                    n++;
                                }
                            }
                        }
                        if (hourEvents.length > 0) {
                            console.log(hourEvents);
                        }
                    }
                return hourEvents;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
