<template>
    <div>
        <button class="delete" @click.stop="dialog = true">
            <img src="../../../../../../public/img/icon/delete.svg" alt="Delete">
        </button>
        <v-dialog
            v-model="dialog"
            hide-overlay
            width="540">
            <div class="delete-info">
                <button class="close-modal-x"  @click="dialog=false"><img src="../../../../../../public/img/icon/close.svg" alt="Close"></button>
                <div class="text-modal">
                    Вы подтверждаете удаление?
                </div>
                <div class="d-flex justify-content-around">
                    <button class="ok" @click="deleteEvent(item)">Да</button>
                    <button class="close" @click="dialog=false">Нет</button>
                </div>
            </div>
        </v-dialog>
    </div>
</template>

<script>
    export default {
        name: "Delete",
        props:['item'],
        data() {
            return {
                menu: false,
                dialog: false,
                getDay:null,
                dateForModal:null
            }
        },
        methods:{
            deleteEvent(event) {
                if (event.type == 'birthday') {
                    this.$store.dispatch('deleteBirthdays', {event: event})
                } else if (event.type == 'activity') {
                    this.$store.dispatch('deleteActivity', {event: event})
                } else if (event.type == 'task') {
                    this.$store.dispatch('deleteTask', {event: event})
                }
            }
        },
    }
</script>

<style scoped>
    .ok:hover,.close:hover
    {
        background: #1875F0;
        color: #FFFFFF;
    }


    .close-modal-x{
        display: flex;
        width: 30px;
        align-self: flex-end;
    }
    .ok,.close{
        width: 120px;
        height: 50px;
        font-family: Roboto;
        font-style: normal;
        font-weight: 900;
        font-size: 12px;
        line-height: 50px;
        text-align: center;
        text-transform: uppercase;
        border: 2px solid #F5F5F5;
        box-sizing: border-box;
        border-radius: 3px;
        color: #B3B3B3;
    }
    .text-modal{
        padding-top: 33px;
        margin-bottom: 60px;
        text-align: center;
        font-family: Roboto;
        font-style: normal;
        font-weight: 500;
        font-size: 18px;
        line-height: 30px;
        text-align: center;
        color: #666666;
    }
    .delete-info{
        height: 214px;
        display: flex;
        flex-direction: column;
    }
</style>
