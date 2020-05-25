<template>
    <v-menu v-model="searchDialog" bottom :offset-y="offset" :close-on-content-click=false>
        <template v-slot:activator="{ on }">
            <button class="dropdown-event menu-search" @click="clearSearch=true" v-on="on">Поиск</button>
        </template>
        <v-list>
            <form onsubmit="return false">
                <div class="d-flex search">
                    <div class="select-event">
                        <div class="title-search">Область поиска*</div>
                        <div class="search-group">
                            <v-select
                                v-model="searchEvents"
                                @change="$v.searchEvents.$touch()"
                                @blur="$v.searchEvents.$touch()"
                                :error-messages="searchEventsErrors"
                                :items="items"
                                :clearable="true"
                                placeholder="Выберите область поиска"
                                multiple
                            >
                                <template v-slot:selection="{ item, index }">
                                    <span v-if="index==0">{{ item }}</span>
                                    <span v-else-if="index>0 && index<2">,{{ item }}</span>
                                    <span
                                        v-else-if="index==2"
                                    >,(+{{ searchEvents.length - 2}} еще)</span>
                                </template>
                            </v-select>
                        </div>
                    </div>
                    <div class="text-search">
                        <div class="title-search">Что</div>
                        <div class="search-group">
                            <v-text-field
                                v-model="description"
                                :error-messages="descriptionErrors"
                                outlined
                                dense
                                placeholder="Ведите ключевые слова для поиска"
                                @input="$v.description.$touch()"
                                @blur="$v.description.$touch()"
                            ></v-text-field>
                        </div>
                    </div>
                    <div class="date-search">
                        <div class="title-search">Дата</div>
                        <div class="search-group">
                            <v-flex xs12 lg6>
                                <v-menu
                                    v-model="openDataStart"
                                    :close-on-content-click="false"
                                    full-width
                                    max-width="290">
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            :value="computedDateFormattedMomentjs"
                                            readonly
                                            outlined

                                            append-icon="keyboard_arrow_down"
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        locale="ru"
                                        v-model="dateStart"
                                        @change="openDataStart = false"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                            <v-flex xs12 lg6>
                                <v-menu
                                    v-model="openDataEnd"
                                    :close-on-content-click="false"
                                    full-width
                                    max-width="290">
                                    <template v-slot:activator="{ on }">
                                        <v-text-field
                                            :value="computedDateFormattedMomentjsForEnd"
                                            outlined
                                            append-icon="keyboard_arrow_down"
                                            readonly
                                            v-on="on"
                                        ></v-text-field>
                                    </template>
                                    <v-date-picker
                                        locale="ru"
                                        v-model="dateEnd"
                                        @change="openDataEnd = false"
                                    ></v-date-picker>
                                </v-menu>
                            </v-flex>
                        </div>
                    </div>
                    <div class="search-btn d-flex justify-content-between">
                        <button @click="discard" type="" color="blue darken-2" dark large>Сброс</button>
                        <button @click="search" color="blue darken-2">Поиск</button>
                    </div>
                </div>
            </form>
        </v-list>
    </v-menu>
</template>

<script>
    import validation from '../../../../mixin/validation'

    export default {
        mixins: [validation],
        data() {
            return {
                searchDialog: false,
                clearSearch: false,
                closeOnClick: true,
                offset: true,
                description: null,
                items: ['Дни рождения', 'Задачи', 'Мероприятия', 'Напоминания'],
                searchEvents: null,
                openDataStart: false,
                openDataEnd: false,
                dateStart: moment(new Date()).format('YYYY-MM-DD'),
                dateEnd: moment(new Date()).format('YYYY-MM-DD'),
            }
        },
        methods: {
            discard() {
                this.$v.$reset();
                this.searchEvents = null;
                this.description = null;
            },
            search() {
                this.$v.$touch()
                if (
                    !this.descriptionErrors.length == 0
                    || !this.searchEventsErrors.length == 0
                ) {
                    this.$toaster.info('Будьте внимательны при заполнении полей.')
                } else {
                    this.$store.dispatch('searchEvents', {
                            search_area: this.searchEvents,
                            description: this.description,
                            date_start: moment(this.dateStart).format('YYYY-MM-DD'),
                            date_end: moment(this.dateEnd).format('YYYY-MM-DD'),
                        }
                    );

                    this.searchEvents = null;
                    this.description = null;
                    this.searchDialog = false;
                }
            },
        },
        watch: {
            clearSearch(value) {
                if (value == true) {
                    this.$v.$reset();
                    this.searchEvents = null;
                    this.description = null;

                }
                this.clearSearch = false;
            },
        }
    }
</script>

<style scoped>
    .search-btn button {
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

    .search-btn button:hover {
        background: #1875F0;
        color: #FFFFFF;
    }

    .title-search {
        display: flex;
        width: 30%;
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        line-height: 50px;
        color: #000000;
    }

    .search-btn {
        width: 290px;
        margin: 0 auto;
    }

    .search-group {
        display: flex;
        width: 97%;
    }

    .search {
        height: 368px;
        width: 530px;
        display: flex;
        margin: 0 auto;
        flex-direction: column;
    }

    .select-event, .text-search, .date-search {
        display: flex;
        width: 100%;
    }

    .v-text-field {
        padding-top: 4px;
        margin-top: 0;
    }

    .menu-search {

        width: 550px;
        height: 50px;
        background: #FFFFFF;
        border: 2px solid #F5F5F5;
        box-sizing: border-box;
        border-radius: 4px;
    }
</style>
