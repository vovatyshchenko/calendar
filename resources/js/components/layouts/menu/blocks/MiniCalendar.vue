<template>
    <div class="mini-calendar">
        <div class="mini-calendar-header">
            {{month}} {{year}}
        </div>
        <div class="mini-calendar-body">
            <table>
                <thead>
                    <tr class="mini-calendar-dayname">
                        <td v-for="d in day">{{d}}</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="week in getMonth" class="mini-calendar-day">
                        <td v-for="(day, index) in week" :class="{activeDay:activeDay(day)}">
                            <router-link to="/day">
                                <span v-on:click="setDate(day)" :class="activeMonth(day)?'activeMonth':'noActiveMonth'">{{currentDate(day)}}</span>
                            </router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                day:["Пн", "Вт","Ср","Чт","Пт","Сб", "Вс"],
                page:0,
                month:0,
                year:0,
                noActive: false
            }
        },
        methods:{
            currentDate(date){
                this.dateForMonth=date;
                let parseDate = this.dateForMonth.split(".");
                return parseDate[0];
            },
            activeMonth(date){
                this.dateForMonth=date;
                let currentMonth = new Date().getMonth();
                let parseDate = this.dateForMonth.split(".");
                if (parseDate[1]==currentMonth+1) {
                    return true;
                } else {
                    return false;
                }
            },
            activeDay(date){
                this.dateForMonth=date;
                let currentDay = new Date().getDate();
                let parseDate = this.dateForMonth.split(".");
                if (parseDate[0]==currentDay) {
                    return true;
                } else {
                    return false;
                }
            },
            setDate(date) {
                let parseDate = date.split(".");
                let fullDate=new Date(parseDate[2], parseDate[1]-1, parseDate[0]);
                this.$store.commit('set_date', fullDate);
            }
        },
        computed:{
            noActiveMonth (){

            },
            getMonth()
            {
                let week=[];
                let monthDividedIntoWeeks=[];
                let counter=0;
                let nowDate = new Date();
                let months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]
                if(this.page!=0)
                {
                    nowDate.setMonth(nowDate.getMonth()+this.page);
                }
                else{
                    nowDate=new Date()
                }
                nowDate.setDate(1);
                this.month=months[nowDate.getMonth()];
                this.year=nowDate.getFullYear();

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

                    if(currentDay==1&&i>7 &&week.length>0)
                    {
                        if(week.length<7)
                        {
                            for (let day=week.length+1;day<=7;day++)
                            {

                                week.push(currentDay+"."+currentMonth+"."+currentYear);
                                param =new Date(nowDate.setDate(nowDate.getDate()+1))
                                currentDay = param.getDate();
                                currentMonth =param.getMonth()+1;
                                currentYear = param.getFullYear();
                            }
                        }

                        monthDividedIntoWeeks.push(week);
                        break;
                    }
                    else if(currentDay==1&&i>7){
                        break;
                    }

                    week.push(currentDay+"."+currentMonth+"."+currentYear)
                    if(i%7==0)
                    {
                        monthDividedIntoWeeks.push(week);
                        week=[];
                        counter++;
                    }
                }
                return  monthDividedIntoWeeks;
            },
        }
    }
</script>

<style scoped>
    .mini-calendar {
        margin: 5px 0 65px;
        background: #FFFFFF;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
        border-radius: 6px;
        width: 260px;
        height: 330px;
    }
    .mini-calendar-header {
        height: 55px;
        border-bottom: 3px solid #F5F5F5;
        text-align: center;
        font-weight: 500;
        font-size: 14px;
        line-height: 60px;
        color: #666666;
    }
    .mini-calendar-body td {
        padding: 10px;
    }
    .mini-calendar-dayname {
        font-weight: bold;
        font-size: 12px;
        line-height: 30px;
        text-align: center;
        letter-spacing: 1px;
        color: #808080;
    }
    .mini-calendar-day {
        font-weight: bold;
        font-size: 12px;
        line-height: 14px;
        text-align: center;
        letter-spacing: 1px;
        color: #999999;
        text-decoration: none;
    }
    .mini-calendar-day a {
        text-decoration: none;
    }
    .mini-calendar-day span {
        cursor: pointer;
    }
    .activeMonth {
        color: #999999;
    }
    .noActiveMonth {
        color: #E6E6E6;
    }
    .activeDay {
        background: #1875F0;
        border-radius: 32px;
    }
    .activeDay span {
        color: #FFFFFF;
    }
</style>
