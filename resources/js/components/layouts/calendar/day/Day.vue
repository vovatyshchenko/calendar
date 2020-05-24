<template>
    <div class="calendar-day">
        <span
            class="day-holiday"
            v-if="holidayTextEventForDay!=null && typeEvent[3]"
            :style="{'background-color': getColor[3]}"
        >{{holidayTextEventForDay}}</span>

        <div v-if="!dayEvents" class="no-day-events">
            <span>На данный день не заплонировано событий!</span>
        </div>

        <div v-if="dayEvents && typeEvent[0]">
            <div class="day-birthdays" :style="{'border-color': getColor[0], 'color': getColor[0]}">
            <span v-for="(birthday, index) in getBirthdays">
                <span v-if="index==0">{{birthday}}</span>
                <span class="birthday-name">{{birthday.name}}</span>
            </span>
            </div>
        </div>
        <div class="day-header" align="left">
            <div class="day-time-header"><span>Время</span></div>
            <div class="day-event-header"><span>Событие</span></div>
        </div>
        <table  width="100%" class="table-day">
            <tr v-for="n in 24">
                <td class="day-time" valign="bottom"><span>{{n}}:00</span></td>
                <td class="day-event" :style="{'background-color': event.color}" v-for="event in showEvents(n)" :rowspan="event.time_length">
                    <div>
                        <div align="right">
                            <button class="create-btn" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                            <button class="delete" v-ripple>
                                <img src="../../../../../../public/img/icon/delete.svg" alt="Delete">
                            </button>
                        </div>
                        <span>{{event.time_start}}-{{event.time_end}} {{event.name}}</span>
                    </div>
                </td>
                <td v-if="showAdditionalEvents(n)[0]">
                    <additional-events :events="showAdditionalEvents(n)[1]"></additional-events>
                </td>
            </tr>
        </table>
    </div>
</template>
<script>
    import holiday from '../../../../mixin/holiday'
    export default {
        mixins: [holiday],
        data: () => ({
            fullDate: 0,
            events: 0,
            displayEvents: 0,
            additionalEvents: 0
        }),
        methods: {
            showEvents(count) {
                let hourEvents = [];
                let n = 0;
                if (this.displayEvents!=null) {
                    for (let i = 0; i < this.displayEvents.length; i++) {
                        if (this.displayEvents[i].hour_start==count-1) {
                            hourEvents[n] = this.displayEvents[i];
                            n++;
                        }
                    }
                    if (hourEvents.length>0) {
                        return hourEvents;
                    }
                }
            },
            showAdditionalEvents(count) {
                let events = [];
                let hourEvents = [];
                let n = 0;
                if (this.additionalEvents!=null) {
                    for (let i = 0; i < this.additionalEvents.length; i++) {
                        if (this.additionalEvents[i].hour_start==count-1) {
                            hourEvents[n] = this.additionalEvents[i];
                            n++;
                        }
                    }
                    if (hourEvents.length>0) {
                        events[0]=true;
                        events[1]=hourEvents;
                        return events;
                    } else {
                        events[0]=false;
                        hourEvents[0]={};
                        hourEvents[0].time_start=false;
                        hourEvents[0].time_end=false;
                        hourEvents[0].name=false;
                        events[1]=hourEvents;
                        return events;
                    }
                }
            }
        },
        computed: {
            getColor() {
                let typeColors = [];
                let type = this.$store.getters.typeColors;
                for (let i=0; i<type.length; i++) {
                    typeColors[i] = this.$store.getters.colors[type[i]];
                }
                return typeColors;
            },
            typeEvent() {
                return this.$store.getters.typeEvent;
            },
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
                    if (n>1) {
                        currentBirthdays[0] = 'Сегодня День рождения у:';
                        return currentBirthdays;
                    } else {
                        return false;
                    }
                }
            },
            dayEvents () {
                let currentDate = this.$store.getters.menuDate;
                let formatCurrentDate = moment(currentDate.getFullYear()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getDate()).format('YYYY-MM-DD');
                this.$store.dispatch('getEvents',{date_start:formatCurrentDate, date_end:formatCurrentDate});
                this.$store.commit('setStartDate',formatCurrentDate);
                this.$store.commit('setEndDate',formatCurrentDate);

                this.events = this.$store.getters.events[formatCurrentDate];
                this.displayEvents=[];
                this.additionalEvents=[];
                if (this.events == null) {
                    return false;
                } else {
                    let currentEvents = [];
                    let countDisplay = 0;
                    let countAdditional = 0;
                    let eventGrid = [24];
                    for (let masCount=0; masCount<24; masCount++) {
                        eventGrid[masCount]=new Array(4);
                    }
                    for (let masCount=0; masCount<24; masCount++) {
                        for (let i = 0; i < this.events.length; i++) {
                            if ((this.events[i].type == 'task' && this.$store.getters.typeEvent[1]) || (this.events[i].type == 'activity' && this.$store.getters.typeEvent[2])) {
                                let parseStart = this.events[i].time_start.split(":");
                                let hourStart = +parseStart[0];
                                if (masCount==hourStart) {
                                    let parseEnd = this.events[i].time_end.split(":");
                                    let hourEnd = 0;
                                    if (+parseEnd[1]>0) {
                                        hourEnd = +parseEnd[0]+1;
                                    } else {
                                        hourEnd = +parseEnd[0];
                                    }
                                    let timeLength = hourEnd-hourStart;

                                    let statusShow=false;
                                    for (let j=0; j<4; j++) {
                                        if (eventGrid[masCount][j]==null){
                                            statusShow=true;
                                            for (let hourCount=masCount; hourCount<(masCount+timeLength); hourCount++) {
                                                eventGrid[hourCount][j]=true;
                                            }
                                            this.displayEvents[countDisplay]=this.events[i];
                                            this.displayEvents[countDisplay].time_length=timeLength;
                                            this.displayEvents[countDisplay].hour_start=hourStart;

                                            if (this.events[i].type == 'task') {
                                                this.displayEvents[countDisplay].color=this.$store.getters.colors[this.$store.getters.typeColors[1]];
                                            } else {
                                                this.displayEvents[countDisplay].color=this.$store.getters.colors[this.$store.getters.typeColors[2]];
                                            }
                                            countDisplay++;
                                            break;
                                        }
                                    }
                                    if (statusShow==false) {
                                        this.additionalEvents[countAdditional]=this.events[i];
                                        this.additionalEvents[countAdditional].hour_start=hourStart;
                                        if (this.events[i].type == 'task') {
                                            this.additionalEvents[countAdditional].color=this.$store.getters.colors[this.$store.getters.typeColors[1]];
                                        } else {
                                            this.additionalEvents[countAdditional].color=this.$store.getters.colors[this.$store.getters.typeColors[2]];
                                        }
                                        countAdditional++;
                                    }
                                }
                            }
                        }
                    }
                    console.log(this.displayEvents);
                    console.log(this.additionalEvents);
                    return true;
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/day.scss";
    .day-holiday {
        color: #fff;
        padding: 5px;
        margin: 15px 0;
        border-radius: 4px;
        font-size: 20px;
    }
    .no-day-events {
        margin: 15px 0;
        color: #B3B3B3;
    }
    .table-day {
        width: 800px;
    }
    .day-time {
        width: 62px;
        height: 60px;
        color: #B3B3B3;
    }
    .table-day tr{
        max-height: 60px;
        border-bottom: 2px solid #F5F5F5;
    }
</style>
