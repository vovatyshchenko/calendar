<template>
    <div class="text-center">
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :nudge-width="200"
            offset-x
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

                <v-list-item>
                    <div>
                        <button>sda</button>
                        <button>ssdda</button>
                        <button class="create-btn" @click="change_show_modal()" v-ripple>Редактировать</button>
                    </div>
                    <v-list-item-action>
                    </v-list-item-action>
                </v-list-item>
                <v-divider></v-divider>
                <div>

                   {{item.name}},,,   {{item.type}}
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
        props:['item'],
        name: "CellItem",
        data(){
           return{
               menu:false
           }
        },
        methods:{
            change_show_modal() {
                this.$store.commit('changeShowModal');
                this.menu = false;
            },
        }


    }
</script>

<style scoped>

</style>
