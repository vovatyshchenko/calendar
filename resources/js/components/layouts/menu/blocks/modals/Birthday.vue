<template>
    <form ref="createEvent"onsubmit="return false">
        {{setValues}}
        <v-progress-linear :active="processing" indeterminate height="5" color="red darken-1"></v-progress-linear>
        <div class="delimiter"></div>
        <v-alert :value="error" type="warning">{{ error }}</v-alert>
        <div class="error-message" v-if="globalErrorMessasge">Заполните все обязательные поля</div>
        <v-text-field
            v-model="name"
            :error-messages="nameErrors"
            outlined
            dense
            label="Название"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <span class="label">Дата/Время</span>
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
            </div>
            <v-menu
                ref="start"
                v-model="OpenTimeStart"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="time"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        class="eer"
                        v-model="time"
                        readonly
                        outlined

                        append-icon="keyboard_arrow_down"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="OpenTimeStart"
                    v-model="time"
                    full-width
                    @click:minute="$refs.start.save(time)"
                ></v-time-picker>
            </v-menu>
        </div>
        <v-col class="d-flex align-items-center">
            <span class="label">Весь день</span>
            <v-checkbox v-model="allDay"></v-checkbox>
        </v-col>
        <v-col class="d-flex align-items-center">
            <span class="label">Каждый год</span>
            <v-checkbox v-model="allYear"></v-checkbox>
        </v-col>
            <v-spacer></v-spacer>
            <div class="d-flex justify-content-between">
                <v-btn v-if="!checkIsUpdate" @click="save" type="submit" color="blue darken-2" dark large>Сохранить</v-btn>
                <v-btn v-else  type="submit"  @click="update"  color="blue darken-2" dark large>Редактировать</v-btn>
                <v-btn color="blue darken-2" dark large @click="closeModal()">Отмена</v-btn>
            </div>
    </form>
</template>

<script>
import validation from '../../../../../mixin/validation'
import notification from '../../../../../mixin/eventNotifications'
export default {

    mixins: [validation,notification],
    data: () => ({
        name:null,
        menu1: false,
        dateStart:null,
        time: null,
        OpenTimeStart: false,
        openDataStart: false,
        allDay:false,
        allYear:false,
        checkUpdate:false,
        id:false
    }),
    computed: {
        checkIsUpdate()
        {
            return this.$store.getters.isUpdateBirthday;
        },
        error() {
            return this.$store.getters.get_error;
        },
        processing() {
            return this.$store.getters.get_processing;
        },
        status() {
            return this.$store.getters.getStatus;
        },
        statusUpdated() {
            return this.$store.getters.getStatusUpdated;
        },
        setValues(){
            this.name=this.$store.getters.getBirthday.name;
            this.dateStart=this.$store.getters.getBirthday.date;
            this.time=this.$store.getters.getBirthday.time;
            this.allDay=this.$store.getters.getBirthday.allDay;
            this.allYear=this.$store.getters.getBirthday.allYear;
            this.id=this.$store.getters.getBirthday.id;
            console.log(this.$store.getters.getBirthday);
        },
    },
    methods: {
        save () {
            this.$v.$touch()
            if (!this.nameErrors.length==0) {
                this.$toaster.info('Будьте внимательны при заполнении полей.');
            } else {
                this.$store.dispatch('birthdayCreate', {
                    name: this.name,
                    time_start: this.time,
                    date: moment(this.dateStart).format('YYYY-MM-DD'),
                    is_remind:this.allDay,
                    is_remind_year:this.allYear,
                });
                this.clear();
            }
        },
        update () {
            this.$v.$touch()
            if (!this.nameErrors.length==0) {
                this.$toaster.info('Будьте внимательны при заполнении полей.');
            } else {
                this.$store.dispatch('birthdayUpdate', {
                    id:this.id,
                    name: this.name,
                    time_start: this.time,
                    date: moment(this.dateStart).format('YYYY-MM-DD'),
                    is_remind:this.allDay,
                    is_remind_year:this.allYear,
                });
                this.clear();
            }
        },
        closeModal() {

            this.$store.commit('changeShowModal');
            this.clear();
        },
        clear () {
            this.$v.$reset();
            this.$store.commit('setIsUpdateBirthday',false);
            this.$store.commit('setBirthdayValuesDefoult');
        }
    },
}


</script>

<style scoped>

</style>
