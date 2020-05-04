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
            let Month=[];
            let month1=[];
            let counter=0;
            let nowDate = new Date();
            let M=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]
            if(this.page!=0)
            {
                nowDate.setMonth(nowDate.getMonth()+this.page);
            }
            else{
                nowDate=new Date()
            }
            nowDate.setDate(1);

            if(nowDate.getDate()-nowDate.getDay()==1)
            {
                nowDate.setDate(nowDate.getDate()-7);

            }
            this.month=M[nowDate.getMonth()];
            this.year=nowDate.getFullYear();
            nowDate.setDate(nowDate.getDate()-nowDate.getDay());

            for(let i=1;;i++){

                let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                let day = param.getDate();
                let month =param.getMonth()+1;
                let year = param.getFullYear();

                if(day==1&&i>7)
                {
                    month1.push(Month);
                    break;
                }
                Month.push(day+"-"+month+"-"+year)
                if(i%7==0)
                {
                    month1.push(Month);
                    Month=[];
                    counter++;
                }
            }
            return month1;
        },

    },

    created(){
        console.log(this.getMonth);
    },
    watch:{
        page(){
            console.log(this.getMonth);
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
