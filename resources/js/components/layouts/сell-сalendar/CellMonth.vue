<template>
    <div>
        <div class="Cell">

            <div v-for="(item,index) in Events">
              <cell-item v-if="index<2"  :item="item"></cell-item>
            </div>
            <div >
                <div v-if="Events?Events.length>2:''" class="text-center">
                    <v-menu top :close-on-click="closeOnClick">
                        <template v-slot:activator="{ on }">
                            <v-btn
                                color="primary"
                                dark
                                v-on="on"
                            >
                                Dropdown
                            </v-btn>
                        </template>

                        <v-list>
                            <div v-for="(item,index) in Events">
                                <cell-item v-if="index>2" :item="item"></cell-item>
                            </div>
                        </v-list>
                    </v-menu>
                </div>
            </div>
            <div class="d-flex flex-column">
               <span class="date">
                   <span class="number">
                      <v-tooltip top v-if="holidayTextEvent">
                         <template v-slot:activator="{ on }">
                              <span  v-on="on":class="holidayTextEvent?'active':''">{{currentDate}}</span>
                        </template>
                        <span class="test">{{holidayTextEvent}}</span>
                        </v-tooltip>
                       <span v-else >{{currentDate}}</span>
                   </span>
               </span>
            </div>
        </div>
    </div>
</template>

<script>
    import CellItem from "./blocks/CellItem";
    import holiday from '../../../mixin/holiday'
    export default {
        props:['date'],
        mixins: [holiday],
        components:{CellItem},
        data(){
            return{
                dateForMonth:"",
                dateForEvents:null,
                text:'',
                closeOnClick: true,
                fav: true,
                menu: false,
                menu2:false,
                message: false,
                hints: true,
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
                this.dateForEvents=moment(parseDate[2]+'-'+parseDate[1]+'-'+parseDate[0]).format('YYYY-MM-DD');
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
            Events(){
               return this.$store.getters.events[this.dateForEvents];
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
