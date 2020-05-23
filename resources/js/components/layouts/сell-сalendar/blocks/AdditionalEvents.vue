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
                <div v-for="event in events" class="additional-event" :style="{'background-color': event.color}">
                    <span>{{event.time_start}}-{{event.time_end}} {{event.name}}</span>
                    <div>
                        <button class="create-btn" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                        <button class="delete" v-ripple>
                            <img src="../../../../../../public/img/icon/delete.svg" alt="Delete">
                        </button>
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
        color: #000;
        border: 1px solid grey;
        border-radius: 5px;
        margin: 10px;
        padding: 5px;
    }
</style>
