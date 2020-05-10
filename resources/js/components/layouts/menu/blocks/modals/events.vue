<template>
    <form  @submit.prevent="submit">
        <div class="error-message" v-if="globalErrorMessasge">Заполните все обязательные поля</div>
        <v-text-field
            v-model="name"
            :error-messages="nameErrors"
            outlined
            dense
            v-model="event.name"
            :rules="rules"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Гости</div>
        <v-text-field
            v-model="guests"
            :error-messages="guestsErrors"
            outlined
            dense
            v-model="event.guests"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Место располодения</div>
        <v-text-field
            v-model="location"
            :error-messages="locationErrors"
            outlined
            dense
            v-model="event.location"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Описание*</div>
        <v-text-field
            v-model="about"
            :error-messages="aboutErrors"
            outlined
            dense
            v-model="event.description"
            :rules="rules"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <span class="mb-2">Начало*:</span>
          <v-text-field
            v-model="date"
            prepend-icon="event"
            readonly
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <span class="mb-2">Окончания*:</span>
        <v-text-field
            v-model="date"
            prepend-icon="event"
            readonly
        ></v-text-field>
      </v-col>
    </v-row>
     <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="storeData()">Сохранить</v-btn>
        <v-btn color="blue darken-1" text @click="closeModal()">Отмена</v-btn>
      </v-card-actions>
  </div>
 </form>
</template>

<script>
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    event: {
            name: null,
            guests: null,
            location: null,
            description: null,
            timeStart: null,
            timeEnd: null,
        },
        rules: [
      v => !!v || "Пожалуйста, заполните поле",
      v =>
          (v && v.length >= 3) ||
          "Поле должно содержать более 3-х символов"
      ],
   }),
    methods: {
          closeModal() {
              this.$store.commit('change_show_modal');
          },
            storeData() {
                this.$store.dispatch('eventStore', this.event);
              }
          },
      computed: {
        showModal() {
          return this.$store.getters.showModal;
        }
      },
}
</script>



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
