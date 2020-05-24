<template>
    <div class="search-result">
        <div class="header d-flex">
            <div class="date d-flex">дата</div>
            <div class="time d-flex">время</div>
        </div>
        <div class="pin-search d-flex flex-column">
            <v-menu bottom :offset-y="true" :close-on-click="true" :close-on-content-click=false
                    v-for="(event, index)  in searchEvent">
                <template v-slot:activator="{ on }">
                    <button class="d-flex w-100 btn" @click="active=true" v-on="on">
                        <span class="date-pin d-flex">{{ event.date_start|dateParse('YYYY-MM-DD') |dateFormat('DD MMMM YYYY,dd') }}</span>
                        <span class="time-pin d-flex">{{ event.time_start}} {{ event.name}}</span>
                    </button>
                </template>
                <v-list v-if="active">
                    <div class="d-flex content-search">
                        <div class="left-content-search">
                            <div class="text-justify" v-if="event.description?event.description:''">
                                Описание:{{event.description}}
                            </div>
                            <div>Начало:{{event.date_start|dateParse('YYYY-MM-DD') |dateFormat('DD.MM.YYYY') }}
                                {{event.time_start}}
                            </div>
                            <div v-if="event.date_end?event.date_end:''">Конец:{{event.date_end|dateParse('YYYY-MM-DD')
                                |dateFormat('DD.MM.YYYY')}} {{event.time_end}}
                            </div>
                        </div>
                        <div class="right-content-search">
                            <delete @close="deleteEvent(searchEvent,index)" :event="event"></delete>
                            <button class="create-btn" @click="edit(event)" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                        </div>
                    </div>
                </v-list>
            </v-menu>
        </div>
    </div>
</template>

<script>
    import notification from '../../../../mixin/eventNotifications'
    export default {
        mixins: [notification],
        name: "ResultSearch",
        data() {
            return {
                active: false,
            }
        },
        computed: {
            searchEvent() {
                return this.$store.getters.searchEvent
            }
        },
        methods: {
            edit(event) {
                this.$store.commit('changeShowModal');
                if (event.type == 'birthday') {
                    this.$store.dispatch('getBirthday', event.id);
                } else if (event.type == 'activity') {
                    this.$store.dispatch('getActivity', event.id);
                } else if (event.type == 'task') {
                    this.$store.dispatch('getTask', event.id);
                }
                this.$eventBus.$emit('type', event.type);
            },
            deleteEvent(events, index) {
                events.splice(index, 1);
                return this.active = false;
            }

        },
        created() {
            this.$store.commit('setSearchActive', true);

            console.log(this.$store.getters.searchActive)
        },
        destroyed() {
            this.$store.commit('setSearchActive', false);

            console.log(this.$store.getters.searchActive)
        }
    }
</script>

<style scoped>

    .date, .date-pin {
        width: 30%;
        justify-content: flex-end;
        padding-right: 10px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 12px;
        line-height: 20px;
        color: #B3B3B3;
    }

    .content-search {
        width: 550px;
    }

    .time-pin {
        padding-left: 0;
        background: #D2EFFE;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 60px;
        color: #2675B5;
    }

    .date-pin {
        padding-top: 20px;
    }

    .time, .time-pin {
        width: 70%;
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

    .left-content-search {
        display: flex;
        width: 90%;
        flex-direction: column;
    }

    .right-content-search {
        display: flex;
        width: 10%;
    }

    .content-search {
        display: flex;
        margin: 0 auto;
        width: 500px;
    }

    .search-result {
        width: 700px;
    }
</style>
