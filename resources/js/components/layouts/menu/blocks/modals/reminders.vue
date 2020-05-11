<template>
    <v-row>
        <v-col cols="11" sm="5">
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
            </v-menu>
            <div class="characters">ваш контент</div>
        </v-col>
        <v-spacer></v-spacer>
        <div class="d-flex justify-content-between">
            <v-btn type="submit" color="blue darken-2" dark large>Сохранить</v-btn>
            <v-btn color="blue darken-2" dark large @click="closeModal()">Отмена</v-btn>
        </div>
    </v-row>
</template>

<script>
export default {
    data () {
        return {
            time: '00:00',
            menu2: false,
            modal2: false,
        }
    },
}
</script>

<style>
    .characters {
        background-color: #fff;
        border-bottom: 7px solid #ffd434;
        position: relative;
    }

    .characters::after {
        border: medium solid transparent;
        content: "";
        top: 100%;
        left: 50%;
        position: absolute;
        height: 0;
        width: 0;
        border-color: #ffd434 rgba(255, 212, 52, 0) rgba(255, 212, 52, 0);
        border-width: 25px;
        margin-left: -25px;
    }
.eer{
    width:100px
}
</style>
