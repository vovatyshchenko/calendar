<template>
    <div>
        <div class="Cell">
            <div class="d-flex flex-column">
               <span class="date">
                   <span class="number">
                      <v-tooltip top v-if="holidayTextEvent">
                         <template v-slot:activator="{ on }">
                              <span v-on="on" :class="holidayTextEvent?'active':''">{{currentDate}}</span>
                        </template>
                        <span class="test">{{holidayTextEvent}}</span>
                      </v-tooltip>
                       <span v-else>{{currentDate}}</span>
                   </span>
               </span>
            </div>
            <div v-for="(item,index) in еvents">
                <cell-item :date="date" v-if="index<2" :index="index" :item="item" :color="item.color"></cell-item>
            </div>
            <div>
                <div v-if="еvents?displayEvents>2:''" class="text-center">
                    <v-menu top :close-on-click="closeOnClick">
                        <template v-slot:activator="{ on }">
                            <button class="dropdown-event" v-on="on">Еще</button>
                        </template>
                        <v-list>
                            <div class="d-flex justify-content-end">
                                <div class="date">
                                    {{dateForModal}}
                                </div>
                                <button class="delete" :close-on-click="closeOnClick">
                                    <img src="../../../../../public/img/icon/clear.svg" alt="Close">
                                </button>
                              </div>
                            <div v-for="(item,index) in еvents">
                                <cell-item :date="date" v-if="index>1" :item="item" :color="item.color"></cell-item>
                            </div>
                        </v-list>
                    </v-menu>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CellItem from "./blocks/CellItem";
    import holiday from '../../../mixin/holiday'

    export default {
        props: ['date'],
        mixins: [holiday],
        components: {CellItem},
        data() {
            return {
                dateForMonth: "",
                dateForEvents: null,
                text: '',
                closeOnClick: true,
                fav: true,
                menu: false,
                menu2: false,
                message: false,
                hints: true,
                dateModal:null
            }
        },
        methods: {
            cutTextFunction(value, symbolsCount) {
                return value.length > symbolsCount
                    ? value.slice(0, symbolsCount - 3) + '...'
                    : value;
            }
        },
        computed: {
            currentDate() {

                this.dateForMonth = this.date;
                let parseDate = this.dateForMonth.split("-");
                this.dateForEvents = moment(parseDate[1] + '-' + parseDate[2]).format('MM-DD');
                let months = ["Декабря","Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября"]
                let daysAbbreviation=['ВC', 'ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ'];
                this.dateModal=daysAbbreviation[new Date(this.dateForEvents).getDay()]+' '+parseDate[2];
                let dateForCalendar = "";
                if (parseDate[2] == '1') {
                    if (parseDate[1] == 12) {
                        dateForCalendar = parseDate[2] + " " + months[0];
                    } else {
                        dateForCalendar = parseDate[2] + " " + months[parseDate[1]];
                    }
                } else {
                    dateForCalendar = parseDate[2];
                }
                return dateForCalendar;
            },

            displayEvents()
            {
                if(typeof(this.еvents)=='object')
                {
                    return Object.keys(this.еvents).length
                }

            },
            еvents()
            {
                let currentEvents= this.$store.getters.events[this.dateForEvents];
                let typeColors = this.$store.getters.typeColors;
                let showEvents = [];
                let count = 0;
                if (currentEvents!=null) {
                    for (let i = 0; i < currentEvents.length; i++) {
                        if ((currentEvents[i].type == 'birthday' && typeColors[0].active) ||
                            (currentEvents[i].type == 'task' && typeColors[1].active) ||
                            (currentEvents[i].type == 'activity' && typeColors[2].active)) {

                            showEvents[count] = currentEvents[i];
                            if (currentEvents[i].type == 'birthday') {
                                showEvents[count].color=this.$store.getters.colors[typeColors[0].color];
                            }
                            if (currentEvents[i].type == 'task') {
                                showEvents[count].color=this.$store.getters.colors[typeColors[1].color];
                            }
                            if (currentEvents[i].type == 'activity') {
                                showEvents[count].color=this.$store.getters.colors[typeColors[2].color];
                            }
                            count++;
                        }
                    }
                    return showEvents;
                }
                return this.$store.getters.events[this.dateForEvents];
            },
            dateForModal()
            {
                return this.dateModal;
            }
        },
        watch: {
            events: function (value) {
                console.log(value.type, value.color);
            }
        },
    }
</script>

<style scoped>
    .delete {
        margin-right:9px;
        margin-left:28px;
    }
    .dropdown-event {
        height: 30px;
        width: 150px;
        background: #D8D8D8;
        border-radius: 4px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 30px;
        color: #666666;
        margin-bottom: 9px;
    }

    .v-tooltip__content {
        background: #F44336;
    }

    .my-tooltip-class {
        min-width: 200px;
        min-height: 118px;
        color: #FFFFFF;
        padding: 5px;
        background: #F44336;
    }

    .Cell .date .number .active {
        color: #FFFFFF;
        padding: 5px;
        background: #F44336;
        border-radius: 3px;
    }

    .Cell {
        min-height: 118px;

        background: #FFFFFF;
        min-width: 158px;
    }

    .Cell .date {
        text-align: end;
    }

    .Cell .date .number {
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 30px;
        margin: 10px 9px;
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

    ul li :hover {

    }

    ul li {
        list-style: none;
        min-width: 150px;
        min-height: 30px;
        border-radius: 4px;
    }
</style>
