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
            label="Название"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>
        <label class="title__input_modal">Гости</label>
        <v-text-field
            v-model="guests"
            :error-messages="guestsErrors"
            outlined
            dense
            label="Гости"
            @input="$v.guests.$touch()"
            @blur="$v.guests.$touch()"
        ></v-text-field>
        <label class="title__input_modal">Место проведения</label>
        <v-text-field
            v-model="location"
            :error-messages="locationErrors"
            outlined
            dense
            label="Место проведения"
            @input="$v.location.$touch()"
            @blur="$v.location.$touch()"
        ></v-text-field>
        <label class="title__input_modal">Описаниe</label>
        <v-text-field
            v-model="description"
            :error-messages="descriptionErrors"
            outlined
            dense
            label="Описание"
            @input="$v.description.$touch()"
            @blur="$v.description.$touch()"
        ></v-text-field>
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <span class="label">начало</span>
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
                <span class="label">конец</span>
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
            guests:null,
            location:null,
            timeStart: '00:00',
            timeEnd: '00:00',
            OpenTimeStart: false,
            openDataStart: false,
            OpenTimeEnd: false,
            openDataEnd: false,
            description:null,
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
                if (value == true) {
                    this.$toaster.success('Данные успешно сохранены.');
                    this.$store.commit("setStatus", false);
                    this.$store.commit('changeShowModal');
                }
            }
        },
        methods: {
            submit () {
                this.$v.$touch()
                if (!this.nameErrors.length==0 ||
                    !this.guestsErrors.length==0||
                    !this.locationErrors.length==0||
                    !this.descriptionErrors.length==0
                ) {
                    this.$toaster.info('Будьте внимательны при заполнении полей.')
                } else {

                    this.$store.dispatch('activityCreate',{
                        name: this.name,
                        guests: this.guests,
                        location: this.location,
                        description: this.description,
                        time_start: this.timeStart,
                        time_end: this.timeEnd,
                        date_end: this.dateEnd,
                        date_start:this.dateStart
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
                this.guests=''
                this.description=''
                this.location=''
                this.email = ''
                this.select = null
                this.checkbox = false
            },
        },
    }
</script>
<style scoped>

</style>
