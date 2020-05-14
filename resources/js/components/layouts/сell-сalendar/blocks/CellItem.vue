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
                <v-btn
                    color="indigo"
                    dark

                    v-on="on"
                >
                   {{item.name|cutText(15)}}
                </v-btn>
            </template>

            <v-card>
                    <div class="d-flex">
                        <button>sda</button>
                        <button>ssdda</button>
                        <v-row justify="center">
                            <v-btn
                                color="primary"
                                dark
                                @click.stop="dialog = true"
                            >
                                Open Dialog
                            </v-btn>

                            <v-dialog
                                hide-overlay
                                v-model="dialog"
                                max-width="290">
                                <div class="flex">
                                    <div class="delete-modal">sdfsfsfsfsfsfsfsfsf</div>
                                    <div class="delete-modal">sdfsfsfsfsfsfsfsfsf</div>
                                    <button @click="deleteEvent(item)">Удалить</button>
                                </div>

                                <button @click="dialog=false">23123</button>
                            </v-dialog>
                        </v-row>
                        <button class="create-btn" @click="changeShowModal()" v-ripple>Редактировать</button>
                    </div>
                    <v-list-item-action>
                    </v-list-item-action>
                <v-divider></v-divider>
                <div>
                   {{index}},,,   {{item.type}}
                </div>
                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn text @click="menu = false">Cancel</v-btn>
                    <v-btn color="primary" text @click="menu = false">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-menu>
    </div>
</template>

<script>
    export default {
        props:['item','index'],
        name: "CellItem",
        data(){
           return{
               menu:false,
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
        methods:{
            changeShowModal() {
                this.$store.commit('changeShowModal');
                this.$eventBus.$emit('type', this.item.type);
                this.menu = false;
            },
            deleteEvent(event)
            {
                if(event.type=='birthday')
                {
                    this.$store.dispatch('deleteBirthdays',{event:event})
                }
                else if(event.type=='activity')
                {
                    this.$store.dispatch('deleteActivity',{event:event})
                }
                else if(event.type=='task')
                {
                    this.$store.dispatch('deleteTask',{event:event})
                }
            }
        },
        watch: {
            statusDelete(value) {
                if (value === true) {
                    this.$toaster.success('Даннык успешно сохраненыw.');
                    this.dialog=false;
                    this.menu=false;
                    this.$store.commit("setStatusDelete", false);
                }
            }
        },


    }
</script>

<style scoped>

    .delete-modal {
    height: 200px;
    background:red;
}
</style>
