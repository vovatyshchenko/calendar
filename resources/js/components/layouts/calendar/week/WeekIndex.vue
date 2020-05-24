<template>
    <div class="calendar-week" align="center">
        <div class="week-info">
            <div class="week-time-header week-header"><span>День</span></div>
            <div class="week-time hour-block" v-for="n in 24"><span>{{n}}:00</span></div>
        </div>
        <div class="week-col" v-for="(date) in dateOfWeek">
            {{date}}
            <cell-week :date="date" :events="events[date]"></cell-week>
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
        methods:{
           currentObj(obj) {
               let currentObj = [];
                Object.keys(obj).forEach(key => {
                    for (let i = 0; i < obj[key].length; i++) {
                        currentObj.push(obj[key][i]);
                    }
                });
                console.log(currentObj);
                return currentObj;
           }
        },
        computed:{
            events(){
                console.log();
              return this.$store.getters.events;
            },
            dateOfWeek() {
                let currentWeek=[];
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
                    let day = parseDate.getDate();
                    let month =((parseDate.getMonth()+1)<10)?'0'+(parseDate.getMonth()+1):parseDate.getMonth();
                    let year = parseDate.getFullYear();

                    this.dayNumber.push(day);
                    currentWeek.push(year+"-"+month+"-"+day)
                    this.$store.commit('setCurrentWeek',currentWeek);
                }
                this.$store.dispatch('getEvents',{date_start:moment(currentWeek[0]).format('YYYY-MM-DD'),date_end:moment(currentWeek[6]).format('YYYY-MM-DD')});
                this.$store.commit('setStartDate',moment(currentWeek[0]).format('YYYY-MM-DD'));
                this.$store.commit('setEndDate',moment(currentWeek[6]).format('YYYY-MM-DD'));

                return currentWeek;
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
