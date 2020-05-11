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
            v-model="about"
            outlined
            dense
            label="Описание*"
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
                                readonly
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
                    @click:minute="$refs.start.save(timeStart)"
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
                                :value="computedDateFormattedMomentjsForEnd"

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
                    @click:minute="$refs.end.save(timeEnd)"
                ></v-time-picker>
            </v-menu>
        </div>
        <v-col cols="12" md="12">
            <span>Весь день</span>
            <v-checkbox v-model="isRemind"></v-checkbox>
        </v-col>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn  type="submit" color="blue darken-1" text >Сохранить</v-btn>
            <v-btn color="blue darken-1" text @click="closeModal()">Отмена</v-btn>
        </v-card-actions>
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
                        date_end: this.dateEnd,
                        is_remind:this.isRemind,
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
                this.about=''
                this.IsAllDay = false
            },
        },
}
</script>

<style>

</style>
