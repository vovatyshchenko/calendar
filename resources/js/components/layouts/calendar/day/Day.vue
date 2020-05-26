<template>
    <div class="calendar-day">
        {{getEvents}}
        <span
            class="day-holiday"
            v-if="holidayTextEventForDay!=null && typeColors[3].active"
            :style="{'background-color': typeColors[3].mainColor, 'color': typeColors[3].textColor}"
        >{{holidayTextEventForDay}}</span>
        <div v-if="!dayEvents" class="no-day-events">
            <span>На данный день не заплонировано событий!</span>
        </div>
        <div v-if="typeColors[0].active ">
            <div class="day-birthdays" :style="{'border-color': typeColors[0].textColor, 'color': typeColors[0].textColor}">
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
                <td class="day-event" :style="{'background-color': event.mainColor, 'color': event.textColor, 'border-color': event.textColor}" v-for="event in showEvents(n)" :rowspan="event.time_length">
                    <div class="d-flex justify-content-between">
                        <span>{{event.time_start}}-{{event.time_end}} {{event.name}}</span>
                        <div align="right">
                            <button @click="edit(event)" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                            <delete :event="event"></delete>
                        </div>
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
    import notification from '../../../../mixin/eventNotifications'
    export default {
        mixins: [holiday, notification],
        data: () => ({
            fullDate: 0,
            events: 0,
            displayEvents: 0,
            additionalEvents: 0,
            eventGrid: 0
        }),
        methods: {
            edit(event) {
                this.$store.commit('changeShowModal');
                if (event.type == 'birthday') {
                    this.$store.dispatch('getBirthday',event.id );
                } else if (event.type == 'activity') {
                    this.$store.dispatch('getActivity',event.id );
                } else if (event.type == 'task') {
                    this.$store.dispatch('getTask',event.id );
                }
                this.$eventBus.$emit('type', event.type);
                this.menu = false;
            },
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
                };
                return hourEvents;
            },
            emptyCell(count) {
                let cells = 0;
                if (typeof this.eventGrid[count-1] != "undefined") {
                    for (let i=0; i<4; i++) {
                        if (this.eventGrid[count-1][i]==true) {
                            cells++;
                        }
                    }
                    let cellsInfo = {};
                    if (cells>0) {
                        cellsInfo.active = false;
                    } else {
                        cellsInfo.active = true;
                    }
                    cellsInfo.cells = 4;
                    return cellsInfo;
                }
                return false;
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
            getEvents() {
                let currentDate = this.$store.getters.menuDate;
                let formatCurrentDate = moment(currentDate.getFullYear()+'-'+(currentDate.getMonth()+1)+'-'+currentDate.getDate()).format('YYYY-MM-DD');

                this.$store.dispatch('getEvents',{date_start:formatCurrentDate, date_end:formatCurrentDate});
                this.$store.commit('setStartDate',formatCurrentDate);
                this.$store.commit('setEndDate',formatCurrentDate);
            },
            typeColors() {
                let typeColors = [];
                for (let i=0; i<this.$store.getters.typeColors.length; i++)
                {
                    typeColors[i] = {};
                    typeColors[i].active = this.$store.getters.typeColors[i].active;
                    typeColors[i].mainColor = this.$store.getters.colors[this.$store.getters.typeColors[i].color];
                    typeColors[i].textColor = this.$store.getters.textColors[this.$store.getters.typeColors[i].color];
                }
                return typeColors;
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
                let formatCurrentDate = moment((currentDate.getMonth()+1)+'-'+currentDate.getDate()).format('MM-DD');

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
                            if ((this.events[i].type == 'task' && this.$store.getters.typeColors[1].active) || (this.events[i].type == 'activity' && this.$store.getters.typeColors[2].active)) {
                                let parseStart = this.events[i].time_start.split(":");
                                let hourStart = +parseStart[0];
                                if (masCount==hourStart) {
                                    let parseEnd = this.events[i].time_end.split(":");
                                    let hourEnd = 0;
                                    if (+parseEnd[1]>0 || parseEnd[0]==parseStart[0]) {
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
                                                this.displayEvents[countDisplay].mainColor=this.$store.getters.colors[this.$store.getters.typeColors[1].color];
                                                this.displayEvents[countDisplay].textColor=this.$store.getters.textColors[this.$store.getters.typeColors[1].color];
                                            } else {
                                                this.displayEvents[countDisplay].mainColor=this.$store.getters.colors[this.$store.getters.typeColors[2].color];
                                                this.displayEvents[countDisplay].textColor=this.$store.getters.textColors[this.$store.getters.typeColors[2].color];
                                            }
                                            countDisplay++;
                                            break;
                                        }
                                    }
                                    if (statusShow==false) {
                                        this.additionalEvents[countAdditional]=this.events[i];
                                        this.additionalEvents[countAdditional].hour_start=hourStart;
                                        if (this.events[i].type == 'task') {
                                            this.additionalEvents[countAdditional].mainColor=this.$store.getters.colors[this.$store.getters.typeColors[1].color];
                                            this.additionalEvents[countAdditional].textColor=this.$store.getters.textColors[this.$store.getters.typeColors[1].color];
                                        } else {
                                            this.additionalEvents[countAdditional].mainColor=this.$store.getters.colors[this.$store.getters.typeColors[2].color];
                                            this.additionalEvents[countAdditional].textColor=this.$store.getters.textColors[this.$store.getters.typeColors[2].color];
                                        }
                                        countAdditional++;
                                    }
                                }
                            }
                        }
                    }
                    this.eventGrid = eventGrid;
                    return true;
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/day.scss";
</style>
