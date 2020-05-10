<template>
    <form ref="createEvent"  @submit.prevent="submit">
        <div class="error-message" v-if="globalErrorMessasge">Заполните все обязательные поля</div>
        <v-text-field
            v-model="name"
            :error-messages="nameErrors"
            outlined
            dense
            label="Название*"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>
        <v-text-field
            v-model="guests"
            :error-messages="guestsErrors"
            outlined
            dense
            label="Гости"
            @input="$v.name.$touch()"
            @blur="$v.name.$touch()"
        ></v-text-field>
        <v-text-field
            v-model="location"
            :error-messages="locationErrors"
            outlined
            dense
            label="Место проведения"
            @input="$v.location.$touch()"
            @blur="$v.location.$touch()"
        ></v-text-field>
        <v-text-field
            v-model="description"
            :error-messages="descriptionErrors"
            outlined
            dense
            label="Описание*"
            @input="$v.description.$touch()"
            @blur="$v.description.$touch()"
        ></v-text-field>
        <div class="d-flex">
            <div>
                <span>начало</span>
                <v-flex xs12 lg6>
                    <v-menu
                        v-model="openDataStart"
                        :close-on-content-click="false"
                        full-width
                        max-width="290">
                        <template v-slot:activator="{ on }">
                            <v-text-field
                                :value="computedDateFormattedMomentjs"
                                clearable

                                readonly
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            locale="ru"
                            v-model="date"
                            @change="openDataStart = false"
                        ></v-date-picker>
                    </v-menu>
                </v-flex>
            </div>
            <v-menu
                ref="menu"
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
                        label="Picker in menu"
                        readonly
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="OpenTimeStart"
                    v-model="timeStart"
                    full-width
                    @click:minute="$refs.menu.save(timeStart)"
                ></v-time-picker>
            </v-menu>
        </div>
        <div class="d-flex">
            <div>
                <span>конец</span>
                <v-flex xs12 lg6>
                    <v-menu
                        v-model="openDataEnd"
                        :close-on-content-click="false"
                        full-width
                        max-width="290">
                        <template v-slot:activator="{ on }">
                            <v-text-field
                                :value="computedDateFormattedMomentjs"
                                clearable

                                readonly
                                v-on="on"
                            ></v-text-field>
                        </template>
                        <v-date-picker
                            locale="ru"
                            v-model="date"
                            @change="openDataEnd = false"
                        ></v-date-picker>
                    </v-menu>
                </v-flex>
            </div>
            <v-menu
                ref="menu"
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
                        label="Picker in menu"
                        readonly
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="OpenTimeEnd"
                    v-model="timeEnd"
                    full-width
                    @click:minute="$refs.menu.save(timeEnd)"
                ></v-time-picker>
            </v-menu>
        </div>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn  type="submit" color="blue darken-1" text >Сохранить</v-btn>
            <v-btn color="blue darken-1" text @click="closeModal()">Отмена</v-btn>
        </v-card-actions>
    </form>
</template>

<script>
    import { validationMixin } from 'vuelidate'
    import { required, email } from 'vuelidate/lib/validators'
    export default {
        mixins: [validationMixin],
        validations: {
            name: { required},
            guests: { required},
            email: { required, email },
            select: { required },
            location: { required },
            description: { required },
            checkbox: {
                checked (val) {
                    return val
                },
            },
        },
        data: () => ({
            name: '',
            menu1: false,
            date: new Date().toISOString().substr(0, 10),
            guests:'',
            location:'',
            timeStart: '00:00',
            timeEnd: '00:00',
            OpenTimeStart: false,
            openDataStart: false,
            OpenTimeEnd: false,
            openDataEnd: false,
            description:'',
        }),
        computed: {
            computedDateFormattedMomentjs () {
                return this.date ? moment(this.date).format('D MMM  YYYY') : ''
            },
            computedDateFormattedDatefns () {
                return this.date ? format(this.date, 'D MMM   YYYY') : ''
            },
            checkboxErrors () {
                const errors = []
                if (!this.$v.checkbox.$dirty) return errors
                !this.$v.checkbox.checked && errors.push('You must agree to continue!')
                return errors
            },
            selectErrors () {
                const errors = []
                if (!this.$v.select.$dirty) return errors
                !this.$v.select.required && errors.push('Item is required')
                return errors
            },
            nameErrors () {
                const errors = []
                if (!this.$v.name.$dirty) return errors
                !this.$v.name.required && errors.push(' ')
                return errors
            },
            guestsErrors () {
                const errors = []
                if (!this.$v.guests.$dirty) return errors
                !this.$v.guests.required && errors.push(' ')
                return errors
            },
            emailErrors () {
                const errors = []
                if (!this.$v.email.$dirty) return errors
                !this.$v.email.email && errors.push('Must be valid e-mail')
                !this.$v.email.required && errors.push()
                return errors
            },
            locationErrors () {
                const errors = []
                if (!this.$v.location.$dirty) return errors
                !this.$v.location.required && errors.push(' ')
                return errors
            },
            descriptionErrors () {
                const errors = []
                if (!this.$v.description.$dirty) return errors
                !this.$v.description.required && errors.push(' ')
                return errors
            },
            globalErrorMessasge(){
                if(this.nameErrors.length>0
                    ||this.guestsErrors.length>0
                    ||this.locationErrors.length>0
                    ||this.descriptionErrors.length>0
                )
                {
                    return true;
                }
                return false;
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
                    this.$toaster.warning('Your toaster warning message.')
                } else {
                    const data = new FormData(this.$refs.createEvent);
                    this.$store.dispatch('activityCreate',{
                        name: this.name,
                        guests: this.guests,
                        location: this.location,
                        description: this.description,
                        timeStart: this.timeStart,
                        timeEnd: this.timeEnd});
                    this.clear()
                }
            },
            closeModal() {
                this.$store.commit('change_show_modal');
            },
            storeData() {
                this.$store.dispatch('bdayStore', this.bday);
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
    .error-message{
        font-family: Roboto;
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        line-height: 60px;
        text-align: center;
        color: #F44336;
    }
</style>
