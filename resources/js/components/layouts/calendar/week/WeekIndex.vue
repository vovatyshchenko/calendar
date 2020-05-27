<template>
    <div>
        <div class="calendar-week" align="center">
            <div class="week-info">
                <div class="week-time-header week-header"><span>День</span></div>
                <div class="week-time hour-block" v-for="n in 24"><span>{{n}}:00</span></div>
            </div>
            <div class="week-col" v-for="(date) in dateOfWeek">
                <cell-week :date="date" :events="events[date]"></cell-week>
            </div>
        </div>
    </div>
</template>
<script>
    import holiday from '../../../../mixin/holiday'
    export default {
        mixins: [holiday],
        name: "WeekIndex",
        data(){
            return{
                page:0,
                dayNumber:[],
            }
        },
        computed:{
            events() {
              return this.$store.getters.events;
            },
            dateOfWeek() {
                let currentWeek=[];
                let eventWeek=[];
                this.dayNumber=[];
                let nowDate=new Date(this.$store.getters.menuDate);
                if (nowDate.getDate() - nowDate.getDay() == 1) {
                    nowDate.setDate(nowDate.getDate() - 7);
                }
                if(nowDate.getDay()==0)
                {
                    nowDate.setDate(nowDate.getDate() - 7);
                }
                nowDate.setDate(nowDate.getDate()-nowDate.getDay());
                for(let i=1;i<=7;i++){

                    let parseDate =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = ((parseDate.getDate()<10)?'0'+parseDate.getDate():parseDate.getDate());
                    let month =((parseDate.getMonth()+1)<10)?'0'+(parseDate.getMonth()+1):parseDate.getMonth();
                    let year = parseDate.getFullYear();

                    this.dayNumber.push(day);
                    currentWeek.push(year+"-"+month+"-"+day);
                    eventWeek.push(month+"-"+day);
                    this.$store.commit('setCurrentWeek',currentWeek);

                }
                this.$store.dispatch('getEvents', {date_start: this.$store.getters.getStartDate, date_end: this.$store.getters.getEndDate})
                //this.$store.dispatch('getEvents',{date_start:moment(currentWeek[0]).format('YYY-MM-DD'),date_end:moment(currentWeek[6]).format('YYYY-MM-DD')});
                this.$store.commit('setStartDate',moment(currentWeek[0]).format('YYYY-MM-DD'));
                this.$store.commit('setEndDate',moment(currentWeek[6]).format('YYYY-MM-DD'));

                return eventWeek;
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
