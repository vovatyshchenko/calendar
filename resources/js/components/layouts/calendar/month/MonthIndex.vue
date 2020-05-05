<template>
    <div>
        {{month}}
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
                    <cell-month :date="day"></cell-month>
<!--                    {{day}} <span v-if="day==1"> {{month}} </span>-->
                </td>
            </tr>
            </tbody>
        </table>
        <button @click="page++">Добавить</button>
        <button @click="page--">Убрать</button>
    </div>
</template>

<script>
export default {
    data(){
        return{
            day:["Понедельник", "Вторник","Среда","Четверг","Пятница","Суббота", "Воскресенье"],
            page:0,
            month:0,
            year:0,
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

                if(currentDay==1&&i>7)
                {
                    if(week.length<7)
                    {
                        for (let day=week.length+1;day<=7;day++)
                        {

                            week.push(currentDay+"-"+currentMonth+"-"+currentYear);
                            param =new Date(nowDate.setDate(nowDate.getDate()+1))
                            currentDay = param.getDate();
                            currentMonth =param.getMonth()+1;
                            currentYear = param.getFullYear();
                        }
                    }

                     monthDividedIntoWeeks.push(week);
                    break;
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
        console.log(this.getMonth);
    },
    watch:{
        page(){

            console.log(this.page);
        }
    }


}
</script>

<style scoped>
    .header{
        max-width: 160px;
        min-height: 90px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 900;
        font-size: 12px;
        line-height: 90px;
        /* identical to box height, or 750% */

        text-align: center;
        letter-spacing: 1.5px;
        text-transform: uppercase;

        color: #B3B3B3;
    }
    .table th, .table td {
        padding:0px;
    }
    .table {
        max-width: 1100px;
    }
    .table td {
        border: 2px solid  #F5F5F5;
    }
</style>
