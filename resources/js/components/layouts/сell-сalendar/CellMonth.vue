<template>
    <div>
        <div class="Cell">
            <div class="d-flex flex-column">
               <span class="date">
                   <span class="number">
                      <v-tooltip top>
                         <template v-slot:activator="{ on }">
                              <span  v-on="on":class="holidayTextEvent?'active':''">{{currentDate}}</span>
                        </template>
                        <span class="test">{{holidayTextEvent}}</span>
                        </v-tooltip>
                   </span>
               </span>
                <ul class="d-flex align-center flex-column">
                    <li :style="{background:item.background}" :class="'event'+index" v-for="(item, index) in Events">
                        <span>{{item.text|cutText(21)}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import holiday from '../../../mixin/holiday'
    export default {
        props:['date'],
        mixins: [holiday],
        data(){
            return{
                dateForMonth:"",
                text:'',
                Events:[
                    {text:'Удивительный хаббл1222' ,background:'#F5E3F9'},
                    {text:'Брендинг знаете ли вы2',background: "#FEEACC"}
                ]
            }
        },
        methods:{
            cutTextFunction(value,symbolsCount){
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
      computed:{
            currentDate(){

                this.dateForMonth=this.date;
                let parseDate = this.dateForMonth.split("-");
                let months=["Декабря","Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября"]
                let dateForCalendar="";
                if(parseDate[0]=='1')
                {
                    if(parseDate[1]==12)
                    {
                        dateForCalendar=parseDate[0]+" "+months[0];
                    }
                    else{
                        dateForCalendar=parseDate[0]+" "+months[parseDate[1]];
                    }
                }
                else{
                    dateForCalendar=parseDate[0];
                }
               return dateForCalendar;
            },
        },
    }
</script>

<style scoped>

    .v-tooltip__content{
        background: #F44336;
    }
    .my-tooltip-class{
        min-width:200px;
        min-height: 118px;
        color: #FFFFFF;
        padding:5px;
        background: #F44336;
    }
    .Cell .date .number .active{
        color: #FFFFFF;
        padding:5px;
        background: #F44336;
        border-radius: 3px;
    }
    .Cell{
        min-height: 118px;

        background: #FFFFFF;
        min-width: 158px;
    }
    .Cell .date{
        text-align: end;
    }
    .Cell .date .number
    {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 30px;
        margin:10px 9px;
        color: #CCCCCC;
    }
    .Cell .event0 {
        /*background: #F5E3F9;*/
        margin-bottom: 5px;
    }
    .Cell .event1 {
        /*background: #FEEACC;*/
    }
    .Cell .event0, .Cell .event1 {
        text-align: center;
    }
    ul {
        margin: 0;
        padding: 0;
    }
    ul li span {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 30px;
    }
    ul li :hover{

    }

    ul li {
        list-style: none;
        min-width: 150px;
        min-height: 30px;
        border-radius: 4px;
    }
</style>
