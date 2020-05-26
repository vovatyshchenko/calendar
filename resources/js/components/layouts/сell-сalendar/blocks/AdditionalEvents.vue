<template>
    <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-width="250"
        offset-x
        left
    >
        <template v-slot:activator="{ on }">
            <button class="additional-btn" v-on="on">
                + {{events.length}}
            </button>
        </template>
        <v-card>
            <div class="additional-events">
                <div v-for="event in events" class="additional-event" :style="{'background-color': event.mainColor, 'color': event.textColor, 'border-color': event.textColor}">
                    <span>{{event.time_start}}-{{event.time_end}} {{event.name}}</span>
                    <div class="d-flex">
                        <button class="create-btn" @click="edit(event)" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                        <delete :event="event"></delete>
                    </div>
                </div>
            </div>
        </v-card>
    </v-menu>
</template>

<script>
    export default {
        props:['events'],
        data: () => ({
            menu: false,
        }),
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
            }
        }
    }
</script>

<style scoped>
    .additional-btn {
        width: 90px;
        height: 65px;
        background-color: #FAFAFA;
        box-sizing: border-box;
        border-radius: 4px;
        margin: 0 5px;
    }
    .additional-btn:active,
    .additional-btn:focus{
        outline: none;
    }
    .additional-events {
        display: flex;
        flex-direction: column;
    }
    .additional-event{
        display: flex;
        justify-content: space-between;
        border: 1px solid;
        border-radius: 5px;
        margin: 10px;
        padding: 5px;
    }
</style>
