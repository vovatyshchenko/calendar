<template>
    <form ref="createEvent" @submit.prevent="submit">
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
        <label class="title__input_modal">Описание*</label>
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
        <v-col class="d-flex align-items-center">
            <span class="label">Весь день</span>
            <v-checkbox v-model="isRemind"></v-checkbox>
        </v-col>
        <v-col class="d-flex align-items-center">
            <span class="label">Каждый год</span>
            <v-checkbox v-model="isRemindYear"></v-checkbox>
        </v-col>
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
        description: null,
        menu1: false,
        dateStart: new Date().toISOString().substr(0, 10),
        timeStart: '00:00',
        OpenTimeStart: false,
        openDataStart: false,
        isRemind:false,
        isRemindYear:false
    }),
    methods: {
        submit () {
            this.$v.$touch()
            if (!this.nameErrors.length==0) {
                this.$toaster.info('Будьте внимательны при заполнении полей.')
            } else {
                this.$store.dispatch('BirthdayCreate',{
                    name: this.name,
                    description: this.description,
                    time: this.timeStart,
                    date: this.dateStart,
                    is_remind:this.isRemind,
                    is_remind_year:this.isRemindYear,
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
            this.IsAllDay = false,
            this.isRemindYear=false;
        },
    },
}


</script>

<style scoped>

</style>
