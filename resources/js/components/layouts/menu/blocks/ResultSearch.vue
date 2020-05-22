<template>
    <div class="search-result">
        <div class="header d-flex">
            <div class="date d-flex">дата</div>
            <div class="time d-flex">время</div>
        </div>
        <div class="pin-search d-flex flex-column">
            <v-menu bottom :offset-y="true" :close-on-click="true" :close-on-content-click=false v-for="(event, index) in searchEvent" >
                <template v-slot:activator="{ on }">
                    <button class="d-flex w-100 btn" v-on="on">
                        <span class="date-pin d-flex">{{ event.date_start|dateParse('YYYY-MM-DD') |dateFormat('DD MMMM YYYY,dd') }}</span>
                        <span class="time-pin d-flex">{{ event.time_start}} {{ event.name}}</span>
                    </button>
                </template>
                <v-list>
                    <div class="d-flex content-search">
                       <div v-if="event.description?event.description:''">Описание:{{event.description}}</div>
                        <div>Начало:{{event.date_start}} {{event.time_start}}</div>
                        <div v-if="event.date_end?event.date_end:''">Конец:{{event.date_end}} {{event.time_end}}</div>
                  </div>
                </v-list>
            </v-menu>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ResultSearch",
       data(){
            return{
            }
       },
        computed:{
            searchEvent()
            {
                return this.$store.getters.searchEvent
            }
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
            },

        },
    }
</script>

<style scoped>
    .btn{

    }
   .date,.date-pin{
       width:30%;
       justify-content: flex-end;
       padding-right: 10px;
       font-family: Roboto;
       font-style: normal;
       font-weight: 500;
       font-size: 12px;
       line-height: 20px;
       color: #B3B3B3;
   }
.content-search{
    width:700px;
}
   .time-pin{
       padding-left: 0;
       background: #D2EFFE;
       font-family: Roboto;
       font-style: normal;
       font-weight: bold;
       font-size: 12px;
       line-height: 60px;

       color: #2675B5;
   }
    .date-pin{
        padding-top: 20px;
    }

   .time,.time-pin{
       width:70%;
       justify-content: flex-start;

   }
    .time {
        padding-left: 10px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 20px;
        color: #808080;

    }
    .content-search{
        flex-direction: column;
        margin: 0 auto;
        width: 500px;
    }
.search-result{
    width:700px;
}
</style>
