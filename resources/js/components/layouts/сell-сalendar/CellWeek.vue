<template>
    <div>
        <div class="week-event-header week-header">
            <div>
                <span>{{getDayWeek}} </span>
                <span class="event">{{holidayTextEvent}}</span>
                <span v-for="(birthday, index) in getBirthdays">
                    <span class="bday" v-if="index==0">{{birthday}}</span>
                    <span class="bday">{{birthday.name}}</span>
                </span>
            </div>
        </div>
        <table>
            <tr class="week-events hour-block" v-for="n in 24">
                <td class="event-block" v-for="(event, index) in getEvent(n)" :key="index" :rowspan="event.time_length">
                    <div class="d-flex justify-content-end">
                        <button class="create-btn" @click="edit(event)" v-ripple><img src="../../../../../public/img/icon/create.svg" alt="Edit"></button>
                        <delete :event="event"></delete>
                    </div>
                    {{ event.name }}
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    import holiday from '../../../mixin/holiday'
    import notification from '../../../mixin/eventNotifications'

    export default {
        props: ['date','events'],
        mixins: [holiday, notification],
        data() {
            return {
                days: ["Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"],
            }
        },
        computed: {
            year() {
                return this.$store.getters.menuDate.getFullYear();
            },
            getDayWeek() {
                let parseDate = this.date.split("-");
                let year = this.year;
                let dayNumber = new Date(year, parseDate[0] - 1, parseDate[1]).getDay();
                return this.days[dayNumber] + ', ' + parseDate[1];
            },
            getBirthdays() {
                let currentBirthdays = [];
                let n = 1;
                if (this.events!=null) {
                    for (let i = 0; i <  Object.keys(this.events).length; i++) {
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
            eventsParse() {
                let obj = this.events;
                let year = this.year;
                let parseDate = this.date.split("-");
                let currentDate = new Date(year, parseDate[0] - 1, parseDate[1]);
                let objCurrentData = [];
                if (obj) {
                    for (let i = 0; i < Object.keys(obj).length; i++) {
                        if (obj[i].type == 'activity' || (obj[i].type == 'task')) {
                            let dateStart = moment(obj[i].date_start);
                            let dateEnd = moment(obj[i].date_end);
                            let dateDiff = dateEnd.diff(dateStart, 'days');
                            for (let d = 0; d <= dateDiff; d++) {
                                if ((moment(obj[i].date_start).add(d, 'days')).isSame(currentDate)) {
                                    objCurrentData.push(obj[i]);
                                }
                            }
                        }
                        /*if (obj[i].type == 'birthday') {
                            if (moment(obj[i].date).isSame(currentDate)) {
                                objCurrentData.push(obj[i]);
                            }
                        }*/
                    }
                }
                return objCurrentData;
            },
        },
        methods: {
            getEvent(count) {
                let objCurrentData = this.eventsParse;
                let hourEvents = [];
                let n = 0;
                if (objCurrentData) {
                    for (let i = 0; i < objCurrentData.length; i++) {
                        if (objCurrentData[i].type == 'task' || objCurrentData[i].type == 'activity') {
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
                                hourEvents[n].time_length = (hourEnd - hourStart);
                                n++;
                            }
                        } else {
                            if (count == 1) {
                                hourEvents.push(objCurrentData[i]);
                                hourEvents[n].time_length = 0;
                            }
                        }
                    }
                }
                return hourEvents;
            },
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
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
