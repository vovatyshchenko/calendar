
<template>
    <form  @submit.prevent="submit">
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
            v-model="about"
            :error-messages="aboutErrors"
            outlined
            dense
            label="Описание*"
            @input="$v.about.$touch()"
            @blur="$v.about.$touch()"
        ></v-text-field>
        <div class="d-flex">
            <div>

            <span>yfxfkj</span>
                <v-flex xs12 lg6>

                    <v-menu
                        v-model="menu1"
                        :close-on-content-click="false"
                        full-width
                        max-width="290"
                    >
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
                            @change="menu1 = false"
                        ></v-date-picker>
                    </v-menu>
                </v-flex>
        </div>
            <v-menu
                ref="menu"
                v-model="menu2"
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
                        label="Picker in menu"
                        readonly
                        v-on="on"
                    ></v-text-field>
                </template>
                <v-time-picker
                    format="24hr"
                    v-if="menu2"
                    v-model="time"
                    full-width
                    @click:minute="$refs.menu.save(time)"
                ></v-time-picker>
            </v-menu></div>

        <b-button  class="btn btn-primary add mt-4" type="submit">Создать</b-button>
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
            about: { required },
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
            time: '00:00',
            menu2: false,
            modal2: false,
            about:'',



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
            aboutErrors () {
                const errors = []
                if (!this.$v.about.$dirty) return errors
                !this.$v.about.required && errors.push(' ')
                return errors
            },
            globalErrorMessasge(){
                if(this.nameErrors.length>0
                    ||this.guestsErrors.length>0
                    ||this.locationErrors.length>0
                    ||this.aboutErrors.length>0
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
                    !this.aboutErrors.length==0
                ) {
                    this.$toaster.warning('Your toaster warning message.')

                } else {
                    // do your submit logic here
                    console.log(this.name);
                    this.clear()
                }
            },
            clear () {
                this.$v.$reset()
                this.name = ''
                this.guests=''
                this.about=''
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
