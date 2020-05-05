<template>
    <div>
    <table class="table table-bordered ">
        <thead>
        <tr class="border">
            <th class="time d-flex  align-items-end " scope="col"><span>День</span></th>
            <th  class="day " scope="col"><span class="d-block"><span>Понедельник,</span><span class="number">2</span></span></th>
            <th class="day " scope="col"><span class="d-block"><span>Вторник,</span><span class="number">2</span></span></th>
            <th class="day " scope="col"><span class="d-block"><span>Среда,</span><span class="number">2</span></span></th>
            <th class="day " scope="col"><span class="d-block"><span>Четверг,</span><span class="number">2</span></span></th>
            <th class="day " scope="col"><span class="d-block"><span>Пятница,</span><span class="number">2</span></span></th>
            <th class="day " scope="col"><span class="d-block"><span>Суббота,</span><span class="number">2</span></span></th>
            <th class="day" scope="col"><span class="d-block"><span>Воскресенье,</span><span class="number">2</span></span></th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item, index) in 24">
            <th scope="row">{{item}}:00</th>
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
<!--            <td></td>-->
        </tr>
        </tbody>
    </table>
        <button @click="page+=7">Добавить</button>
        <button @click="page-=7">Убрать</button>
</div>
</template>

<script>
    export default {
        name: "WeekIndex",
        data(){
            return{
                page:0,
                f:0,
                year:0,
            }
        },
        methods:{
        },
        computed:{
            getWeek() {
                let currentWeek=[];
                let timestamp=[];
                let nowDate=new Date();
                if(this.page!=0)
                {

                    nowDate.setDate(nowDate.getDate()+this.page);
                }
                else{
                    nowDate=new Date()
                }


                nowDate.setMonth(this.f);
                nowDate.setDate(nowDate.getDate()-nowDate.getDay());
                let months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]
                this.month=months[nowDate.getMonth()];
                this.year=nowDate.getFullYear();
                for(let i=1;i<=7;i++){

                    let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                    let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                    let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                    let year = param.getFullYear();
                    timestamp.push(+new Date(param));
                    currentWeek.push(day+"."+month+"."+year)
                }
                return {'currentWeek':currentWeek,'timestamp':timestamp};
            }
        },
        created(){
            this.f=3;
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
