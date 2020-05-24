<template>
    <div class="text-center">
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :min-height="600"
            :nudge-width="200"
            :min-width="300"
            offset-x
            :left="(setPosition==0)?true:false"
        >
            <template v-slot:activator="{ on }">
               <button class="event" v-on="on">{{item.name|cutText(15)}}</button>
            </template>
            <v-card>
                <div class="d-flex justify-content-end">
                    <button class="delete" @click.stop="dialog = true">
                        <img src="../../../../../../public/img/icon/email.svg" alt="Email">
                    </button>
                    <delete @close="close($event)" :event="item"></delete>
                    <button class="create-btn" @click="edit(item)" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                    <button class="create-btn clear" @click="close()"><img src="../../../../../../public/img/icon/clear.svg" alt="Clear"></button>
                </div>
                <div class="container-event">
                    <div class="text">
                        {{item.name}}
                    </div>
                    {{currentDate}}
                </div>
            </v-card>
        </v-menu>
    </div>
</template>

<script>
    import notification from '../../../../mixin/eventNotifications'
    export default {
        mixins: [notification],
        props: ['item', 'index','date','getDate'],
        name: "CellItem",
        data() {
            return {
                menu: false,
                getDay:null,
                dateForModal:null
            }
        },
        computed: {
            error() {
                return this.$store.getters.get_error;
            },
            processing() {
                return this.$store.getters.get_processing;
            },

            currentDate() {
                let parseDate = this.date.split("-");
               let dateCurrent = new Date(parseDate[0],parseDate[1]-1,parseDate[2]);
                let months = ["января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "ментября", "октября", "ноября","декабря"]
                let days = ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
                this.getDay=dateCurrent.getDay();
                return days[dateCurrent.getDay()]+","+parseDate[2]+' '+months[parseDate[1]-1]

            },
            setPosition()
            {
                return this.getDay;
            },
        },
        methods: {
            edit(event) {
                this.$store.commit('changeShowModal');
                if (event.type == 'birthday') {
                    this.$store.dispatch('getBirthday',event.id );
                } else if (event.type == 'activity') {
                    this.$store.dispatch('getActivity',event.id );
                } else if (event.type == 'task') {
                    this.$store.dispatch('getTask',event.id );
                }
                this.$eventBus.$emit('type', event.type);
                this.menu = false;
            },
            close(event=null)
            {
                return  this.menu=event;
            }
        },
        created(){

        },
        watch: {

        },
    }
</script>

<style scoped>
    .container-event
    {
        margin: 6px 14px 0 20px;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 30px;

        color: #000000;
    }
    .clear{
    margin-left: 10px;
    }

    .text{

    }
    .event
    {
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
</style>
