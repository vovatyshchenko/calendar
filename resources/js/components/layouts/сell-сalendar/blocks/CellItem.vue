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
                    Menu as Popover
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
                                    <button @click="deleteEvent(item,index)">Удалить</button>
                                </div>

                                <button @click="dialog=false">23123</button>
                            </v-dialog>
                        </v-row>
                        <button class="create-btn" @click="change_show_modal()" v-ripple>Редактировать</button>
                    </div>
                    <v-list-item-action>
                    </v-list-item-action>
                <v-divider></v-divider>
                <div>
<!--                    {{item}}-->
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
            status() {
                return this.$store.getters.getStatus;
            },
        },
        methods:{
            change_show_modal() {
                this.$store.commit('changeShowModal');
                this.$eventBus.$emit('type', this.item.type);
                this.menu = false;
            },
            deleteEvent(event,index)
            {
                if(event.type=='birthday')
                {
                    this.$store.dispatch('deleteEvent',{event:event,date:'2020-05-14',index:index})
                }
                else if(event.type=='activity')
                {
                    axios.delete('/delete-activity/'+id).then((response) =>{
                        if(response.data.response=='deleted')
                        {
                            this.$toaster.success("Запись успешно удалена");
                        }
                    }).catch(e => {
                        this.$toaster.error("Пользователь не найден");
                    });
                }
                else if(event.type=='task')
                {
                    axios.delete('/delete-task/'+id).then((response) =>{
                        if(response.data.response=='deleted')
                        {
                            this.$toaster.success("Запись успешно удалена");
                        }
                    }).catch(e => {
                        this.$toaster.error("Пользователь не найден");
                    });
                }
            }
        },
        watch: {
            status(value) {
                if (value === true) {
                    this.$toaster.success('Даннык успешно сохранены.');
                    this.$store.commit("setStatus", false);
                    this.dialog=false;
                    this.menu=false;
                    this.$store.commit('changeShowModal');
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
