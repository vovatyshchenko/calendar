<template>
    <div>

        {{mon}}
        {{year}}
        <table class="table">
            <thead>
            <tr>
                <td class="header" v-for="d in day">{{d}}</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="week in getMonth">
                <td v-for="(day, index) in week">
                    {{day}}
                    <!--                      <cell-month :date="day"></cell-month>-->
                    <!--                    {{day}} <span v-if="day==1"> {{month}} </span>-->
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>
    export default {

        name: "CellYear",
        props:['year','month'],
        data(){
            return{
                day:["Понедельник", "Вторник","Среда","Четверг","Пятница","Суббота", "Воскресенье"],
                page:0,
                mon:0,
                yea:0,
            }
        },
        methods:{},
        computed:{
            getMonth()
            {
                let week=[];
                let monthDividedIntoWeeks=[];
                let counter=0;
                let nowDate = new Date();
                let months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]

                nowDate.setDate(1);
                nowDate.setMonth(this.month-1);
                nowDate.setFullYear(this.year);
                let LastMonth=nowDate.getMonth();
                this.mon=months[nowDate.getMonth()];
                this.yea=nowDate.getFullYear();
                if(nowDate.getDate()-nowDate.getDay()==1)
                {
                    nowDate.setDate(nowDate.getDate()-7);
                }

                nowDate.setDate(nowDate.getDate()-nowDate.getDay());

                for(let i=1;;i++){

                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let currentDay = param.getDate();
                    let currentMonth =param.getMonth()+1;
                    let currentYear = param.getFullYear();
                    console.log(currentMonth);
                    if(currentDay==1&&i>7)
                    {

                        monthDividedIntoWeeks.push(week);
                        break;
                    }

                    if(currentMonth==LastMonth||(LastMonth==0 && currentMonth==12))
                    {
                        week.push(null);
                        continue;
                    }
                    week.push(currentDay+"-"+currentMonth+"-"+currentYear)
                    if(i%7==0)
                    {

                        monthDividedIntoWeeks.push(week);
                        week=[];
                        counter++;
                    }
                }

                return  monthDividedIntoWeeks;
            },

        },

        created(){

        },

    }
</script>

<style scoped>
.table{
    max-width: 500px;
}
</style>
