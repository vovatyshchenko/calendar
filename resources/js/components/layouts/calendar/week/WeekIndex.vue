<template>
    <div class="calendar-week" align="center">
        <div class="week-header">
            <div class="week-time-header"><span>День</span></div>
            <div v-for="n in 7" class="week-event-header"><span>{{days[n-1]}}</span></div>
        </div>
        <div class="week-body">
            <div class="hour-block" v-for="n in 24" align="left">
                <div class="week-time"><span>{{n}}:00</span></div>
                <div v-for="n in 7" class="week-events">
                    <cell-week></cell-week>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "WeekIndex",
        data(){
            return{
                days: ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"],
                page:0,
                year:0,
                dayNumber:[],

            }
        },
        methods:{
          getDayFromDate(date){
              switch (date) {
                  case 0:
                       return 'Понедельник'
                      break;
                  case 1:
                      return 'Вторник'
                      break;
                  case 2:
                      return 'Среда'
                      break;
                  case 3:
                      return 'Четверг'
                      break;
                  case 4:
                      return 'Пятница'
                      break;
                  case 5:
                      return 'Суббота'
                      break;
                  case 6:
                      return 'Воскресенье'
                      break;
                  default:
                      break;
              }
          }
        },
        computed:{
            getWeek() {
                let currentWeek=[];
                let timestamp=[];
                this.dayNumber=[];
                let nowDate=new Date();
                if(this.page!=0)
                {

                    nowDate.setDate(nowDate.getDate()+this.page);
                }
                else{
                    nowDate=new Date()
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
                    currentWeek.push(day+"."+month+"."+year)
                }
                return currentWeek;
            },

            ger()
            {
                console.log('f');
                return this.$store.getters.displayDate;
            }

        },

        watch:{
            page(){
                console.log(this.getWeek);
            },

        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/week.scss";
</style>
