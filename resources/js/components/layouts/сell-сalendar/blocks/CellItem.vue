<template>
    <div class="text-center">
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :min-height="600"
            :nudge-width="200"
            :min-width="300"
            offset-x
            :left="false"
        >
            <template v-slot:activator="{ on }">
               <button class="event" v-on="on">{{item.name|cutText(15)}}</button>
            </template>
            <v-card>
                <div class="d-flex justify-content-end">
                    <button class="delete" @click.stop="dialog = true">
                        <img src="../../../../../../public/img/icon/email.svg" alt="Email">
                    </button>
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
                    <button class="create-btn" @click="changeShowModal()" v-ripple><img src="../../../../../../public/img/icon/create.svg" alt="Edit"></button>
                    <button class="create-btn clear" @click="menu = false"><img src="../../../../../../public/img/icon/clear.svg" alt="Clear"></button>
                </div>
                <div>
                    {{item.name}}
                </div>
            </v-card>
        </v-menu>
    </div>
</template>

<script>
    export default {
        props: ['item', 'index'],
        name: "CellItem",
        data() {
            return {
                menu: false,
                dialog: false,
            }
        },
        computed: {
            error() {
                return this.$store.getters.get_error;
            },
            processing() {
                return this.$store.getters.get_processing;
            },
            statusDelete() {
                return this.$store.getters.setStatusDelete;
            },
        },
        methods: {
            changeShowModal() {
                this.$store.commit('changeShowModal');
                this.$eventBus.$emit('type', this.item.type);
                this.menu = false;
            },
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
        watch: {
            statusDelete(value) {
                if (value === true) {
                    this.$toaster.success('Даннык успешно сохраненыw.');
                    this.dialog = false;
                    this.menu = false;
                    this.$store.commit("setStatusDelete", false);
                }
            }
        },

    }
</script>

<style scoped>
    .clear{
    margin-left: 10px;
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
    .ok:hover,.close:hover
    {
        background: #1875F0;
        color: #FFFFFF;
    }
    .delete-info{
        height: 214px;
        display: flex;
        flex-direction: column;
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
    .close-modal-x{
        display: flex;
        width: 30px;
        align-self: flex-end;
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
