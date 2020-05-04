<template>
    <table class="table">
        <thead>
        <tr>
            <td v-for="d in day">{{d}}</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="week in 4">
            <td v-for="(day, index) in 7">
                <cell-month></cell-month>
<!--                <CellMonth></CellMonth>-->
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    data(){
        return{
            day:["апвпвп", "укеукеуке","кеукеуеуе","кеуеуеуе","кеуеуеу","укеуеуе", "кеукеуеуеуеуе"],
        }
    },
    methods:{
        calendar: function(){
            var days = [];
            var week = 0;
            days[week] = [];
            var dlast = new Date(this.year, this.month + 1, 0).getDate();
            for (let i = 1; i <= dlast; i++) {
                if (new Date(this.year, this.month, i).getDay() != this.dFirstMonth) {
                    a = {index:i};
                    days[week].push(a);
                } else {
                    week++;
                    days[week] = [];
                    a = {index:i};
                    days[week].push(a);
                }
            }
            if (days[0].length > 0) {
                for (let i = days[0].length; i < 7; i++) {
                    days[0].unshift('');
                }
            }
            this.dayChange;
            return days;
        },
        getNow() {
            let currentWeek=[];
            let timestamp=[];
            let nowDate = new Date();
            nowDate.setDate(nowDate.getDate()-nowDate.getDay());
            for(let i=1;i<7;i++){
                let param =new Date(nowDate.setDate(nowDate.getDate()+1))
                let day = param.getDate()<10?'0'+param.getDate():param.getDate();
                let month = param.getMonth()+1<10?'0'+(param.getMonth()+1):param.getMonth()+1;
                let year = param.getFullYear();
                timestamp.push(+new Date(param));
                currentWeek.push(day+"."+month+"."+year)
            }
            return {'currentWeek':currentWeek,'timestamp':timestamp};
        }
    }
}
</script>

<style>

</style>
