<template>
    <div>
    <div>
        {{getABC}}
        <span>День</span>
        <ul>
            <li class="p-4" v-for="(item,index) in 24">{{item}}</li>
        </ul>
    </div>
     <div v-for="(r,index) in 7">
         <span>понедельник</span>
         <ul>
             <li class="p-4" v-for="(item,index) in 24">{{item}}</li>
         </ul>
     </div>

</div>
</template>

<script>
    export default {
        name: "WeekIndex",
        data(){
            return{
                page:0,
                year:0,
                dayNumber:[]
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
            getABC() {
                return this.$store.getters.menuDate;
            }

        },


        created(){
        },
        watch:{
            page(){
                console.log(this.getWeek);
            }
        }
    }
</script>

<style scoped>
    .time span{
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 20px;
        color: #808080;
        margin: 0 auto 44px auto;

    }
    .day {
        width: 148px;
        height:208px;

    }
    .time{
        width: 63px;
        height:208px
    }
    table th{
        padding:0;
    }
    table {
        max-width: 1110px;
    }
    .day .number {
        margin-left: 11px;
    }
    .day span {
        font-family: Roboto;
        font-style: normal;
        font-weight: 900;
        font-size: 12px;
        line-height: 90px;
        text-align: center;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #B3B3B3;
        padding:0  0 106px 0;
    }
</style>
