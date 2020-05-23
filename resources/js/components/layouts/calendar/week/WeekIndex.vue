<template>
    <div class="calendar-week" align="center">
        <div class="week-info">
            <div class="week-time-header week-header"><span>День</span></div>
            <div class="week-time hour-block" v-for="n in 24"><span>{{n}}:00</span></div>
        </div>
        <div class="week-col" v-for="(date) in dateOfWeek">
            <cell-week :date="date" :events="currentObj(events)"></cell-week>
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
                year:0,
                dayNumber:[],
                month: 0,
                events: {},
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
                return currentObj;
           }
        },
        computed:{
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
                let months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]
                this.day=nowDate.getDay();
                this.month=months[nowDate.getMonth()];
                this.year=nowDate.getFullYear();
                for(let i=1;i<=7;i++){

                    let parseDate =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = parseDate.getDate();
                    let month =parseDate.getMonth()+1;
                    let year = parseDate.getFullYear();

                    this.dayNumber.push(day);
                    currentWeek.push(year+"-"+month+"-"+day)
                    this.$store.commit('setCurrentWeek',currentWeek);
                }
                this.$store.dispatch('getEvents',{date_start:moment(currentWeek[0]).format('YYYY-MM-DD'),date_end:moment(currentWeek[6]).format('YYYY-MM-DD')});
                this.$store.commit('setStartDate',moment(currentWeek[0]).format('YYYY-MM-DD'));
                this.$store.commit('setEndDate',moment(currentWeek[6]).format('YYYY-MM-DD'));
                this.events = this.$store.getters.events;
                return currentWeek;
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
