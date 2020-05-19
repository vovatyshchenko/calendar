<template>
    <form ref="createEvent"  @submit.prevent="submit">
        <v-progress-linear :active="processing" indeterminate height="5" color="red darken-1"></v-progress-linear>
        <v-alert :value="error" type="warning">{{ error }}</v-alert>
        <div class="error-message" v-if="globalErrorMessasge">Заполните все обязательные поля</div>
        <label class="title__input_modal">Название*</label>
        <v-text-field
            v-model="name"
            :error-messages="nameErrors"
            outlined
            dense
            label="Название*"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>
        <label class="title__input_modal">Описание*</label>
        <v-textarea
            v-model="about"
            :error-messages="nameErrors"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
            outlined
            dense
            label="Описание*"
        ></v-textarea>
         <v-col class="d-flex align-items-center">
            <span>Весь день</span>
            <v-checkbox v-model="isRemind"></v-checkbox>
        </v-col>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <span class="label">начало*</span>
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
                                :disabled="isRemind"
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
                :return-value.sync="timeStart"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        class="eer"
                        v-model="timeStart"
                        readonly
                        outlined
                        :disabled="isRemind"
                        append-icon="keyboard_arrow_down"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="OpenTimeStart"
                    v-model="timeStart"
                    full-width
                    @click:minute="$refs.start.save(timeStart)"
                ></v-time-picker>
            </v-menu>
        </div>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <span class="label">окончания*</span>
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
                                :disabled="isRemind"
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
            <v-menu
                ref="end"
                v-model="OpenTimeEnd"
                :close-on-content-click="false"
                :nudge-right="40"
                :return-value.sync="timeEnd"
                transition="scale-transition"
                offset-y
                max-width="290px"
                min-width="290px"
            >
                <template v-slot:activator="{ on }">
                    <v-text-field
                        class="eer"
                        v-model="timeEnd"
                        readonly
                        outlined
                        :disabled="isRemind"
                        append-icon="keyboard_arrow_down"
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="OpenTimeEnd"
                    v-model="timeEnd"
                    full-width
                    @click:minute="$refs.end.save(timeEnd)"
                ></v-time-picker>
            </v-menu>
        </div>
       
            <v-spacer></v-spacer>
           <div class="d-flex justify-content-between">
                <v-btn type="submit" color="blue darken-2" dark large>Сохранить</v-btn>
                <v-btn color="blue darken-2" dark large @click="closeModal()">Отмена</v-btn>
            </div>
    </form>
</template>

<script>
    import validation from '../../../../../mixin/validation'
export default {
        mixins: [validation],
        data: () => ({
            name:null,
            menu1: false,
            dateStart: new Date().toISOString().substr(0, 10),
            dateEnd: new Date().toISOString().substr(0, 10),
            timeStart: '00:00',
            timeEnd: '00:00',
            OpenTimeStart: false,
            openDataStart: false,
            OpenTimeEnd: false,
            openDataEnd: false,
            about:null,
            isRemind:false
        }),
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
    watch: {
        status(value) {
            if (value === true) {
                this.$toaster.success('Данные успешно сохранены.');
                this.$store.commit("setStatus", false);
                this.$store.commit('changeShowModal');
            }
        }
    },
        methods: {
            submit () {
                this.$v.$touch()
                if (!this.nameErrors.length==0) {
                    this.$toaster.info('Будьте внимательны при заполнении полей.')
                } else {
                    this.$store.dispatch('taskCreate',{
                        name: this.name,
                        description: this.about,
                        time_start: this.timeStart,
                        time_end: this.timeEnd,
                        date_start:this.dateStart,
                        date_end: this.dateEnd,
                        is_remind:this.isRemind,
                    });
                    this.clear()
                }
            },
            closeModal() {
                this.$store.commit('changeShowModal');
            },
            clear () {
                this.$v.$reset()
                this.name = ''
                this.about = ''
                this.time_start = '00:00'
                this.time_end = '00:00'
                this.date_start = new Date().toISOString().substr(0, 10)
                this.date_end = new Date().toISOString().substr(0, 10)
                this.IsAllDay = false
            },
        },
}
</script>

<style>

</style>
