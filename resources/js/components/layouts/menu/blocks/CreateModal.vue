<template>
  <v-row justify="center">
    <v-dialog v-model="showModal" persistent max-width="800px">
      <v-card>
        <v-card-title>
            <v-tabs
                v-model="tab"
                background-color="transparent"
            >
                <v-tab
                    v-for="item in items"
                    :key="item"
                >
                    {{ item }}
                </v-tab>
            </v-tabs>
            <!--<v-btn icon  @click="todo"><v-icon>mdi-close</v-icon></v-btn>-->
        </v-card-title>
        <v-tabs-items v-model="tab">
            <v-tab-item>
                <v-card-text>
                    <events-modal></events-modal>
                </v-card-text>
            </v-tab-item>
             <v-tab-item>
                <v-card-text>
                    <reminders-modal></reminders-modal>
                </v-card-text>
            </v-tab-item>
           <v-tab-item>
                <v-card-text>
                    <tasks-modal></tasks-modal>
                </v-card-text>
            </v-tab-item>
            <v-tab-item>
                <v-card-text>
                    <bdays-modal></bdays-modal>
                </v-card-text>
            </v-tab-item>
        </v-tabs-items>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
	export default {
        
        data: () => ({ 
            tab: null,
            items: [
                'МЕРОПРИЯТИЕ', 'НАПОМИНАНИЕ', 'ЗАДАЧА', 'ДЕНЬ РОЖДЕНИЯ',
            ],
        }),
       
        computed: {
            showModal() {
                return this.$store.getters.showModal;
            }
        },
	}
</script>
<style scoped type="scss">
    
</style>
<!--<template>
    <v-dialog
        v-model="showModal"
        max-width="750"
        persistent
    >
        <v-card>
            <div class="modal-wrapper">
                <div class="modal-container " >
                    <div class="modal-header">
                        <v-row>
                            <v-col class="cols 3">
                                <a href="">МЕРОПРИЯТИЕ</a>
                            </v-col>
                            <v-col class="cols 3">
                                <a href="">НАПОМИНАНИЕ</a>
                            </v-col>
                            <v-col class="cols 3">
                                <a href="">ЗАДАЧА</a>
                            </v-col>
                            <v-col class="cols 3">
                                <button class="modal-default-button" @click="change_show_modal()">
                                    <span class="close"></span>
                                </button>
                            </v-col>
                        </v-row>
                        <hr class="line">
                    </div>
                    <div class="modal-body">
                        <div class="p-5">
                            <p class="name">Название*</p>
                            <input class="name_input" type="text" size="53">
                        </div>
                        <div class="p-0">
                            <p class="name">Гости</p>
                            <input class="name_input" type="text" size="53">
                        </div>
                        <div class="p-0">
                            <p class="name">Место расположения</p>
                            <input class="name_input" type="text" size="53">
                        </div>
                        <div class="p-0">
                            <p class="name">Описание*</p>
                            <input class="name_input" type="text" size="53">
                        </div>
                        <v-row>
                            <v-col class="4">
                                <p class="name">Начало*</p>
                            </v-col>
                            <v-col class="4">
                                <input type="date" id="begin" name="party" >
                            </v-col>
                            <v-col class="4">
                                <input type="time">
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col class="4">
                                <p class="name">Окончание*</p>
                            </v-col>
                            <v-col class="4">
                                <input type="date" id="end" name="party" >
                            </v-col>
                            <v-col class="4">
                                <input type="time">
                            </v-col>
                        </v-row>
                    </div>

                    <div class="modal-footer">
                        <v-row>
                            <v-col class="cols 6" id="btn_save">
                                <a href="">СОХРАНИТЬ</a>
                            </v-col>
                            <v-col class="cols 6" >
                                <a href="">ОТМЕНИТЬ</a>
                            </v-col>
                        </v-row>
                    </div>
                </div>
            </div>
        </v-card>
    </v-dialog>

</template>


<script>
    export default {
        data: () => ({
            format: 'dddd MMMM Do, YYYY',
            date: new Date(),
        }),
        methods: {
            change_show_modal() {
                this.$store.commit('change_show_modal');
            },
        },
        computed: {
            showModal() {
                return this.$store.getters.showModal;
            }
        },
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: table;
        transition: opacity 0.3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        margin: 0px auto;
        padding: 5px 0px;
        background-color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
        transition: all 0.3s ease;
        font-family: Roboto, sans-serif;
    }

    /*odal-header  {
        margin-top: 0;
        color: #1875F0;
    }*/

    .modal-body {
        margin: 0;
    }

    .modal-default-button {
        float: right;
    }

    .modal-enter {
        opacity: 0;
    }

    .modal-leave-active {
        opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    /*
    Крестик закрытия
     */
    .close {
        position: relative;
        right: 40px;
        top: 15px;
        width: 32px;
        height: 32px;
        opacity: 0.3;
    }
    .close:hover {
        opacity: 1;
    }
    .close:before, .close:after {
        position: absolute;
        left: 15px;
        content: ' ';
        height: 20px;
        width: 2px;
        background-color: #D8D8D8;
    }
    .close:before {
        transform: rotate(45deg);
    }
    .close:after {
        transform: rotate(-45deg);
    }
    /*
    Кнопки
     */
    a {
        text-decoration: none;
        width: 129px;
        height: 50px;
        text-align: center;
        outline: none;
        display: inline-block;
        padding: 20px 10px;
        margin-left: 45px;
        position: relative;
        border: 1px solid #F5F5F5;
        overflow: hidden;
        border-radius: 6px;
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        font-weight: 500;
        color: #B2B2B2;
        cursor: pointer;
        transition: .2s ease-in-out;
    }
    a:before {
        content: "";
        height: 50px;
        width: 50px;
        position: absolute;
        top: -8px;
        left: -75px;

    }
    a:hover {
        background: #1875F0 ;
        color: #fff;
    }
    a:hover:before {
        left: 150px;
        transition: .5s ease-in-out;
    }
    .line {
        border: none;
        background-color: #F5F5F5;
        height: 2px;
    }
    /*
    формы ввода
     */
    .name {
        font-family: 'Roboto', sans-serif;
        font-size: 12px;
        font-weight: 700;
        color: #808080;
        margin: 0px 80px;
        padding: 5px !important;
    }
    .name_input {
        margin: 2px 60px;
        border: 2px solid #F5F5F5;
        padding: 5px 5px;
        border-radius: 6px;
    }
    /* выбор даты и время*/

    #begin {
        margin-left: 20px;
    }
    #btn_save {
        margin-left: 75px;
    }
</style>-->
