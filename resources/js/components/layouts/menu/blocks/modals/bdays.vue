<template>
  <div>
    <v-row>
      <v-col cols="12" md="12">
        <div class="mb-2">Название*</div>
        <v-text-field
            label="Название"
            outlined
            dense
            :rules="rules"
            v-model="bday.name"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Описание*</div>
        <v-text-field
            label="Описание"
            outlined
            dense
            :rules="rules"
            v-model="bday.description"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <span class="mb-2">Дата/Время:</span>
          <v-time-picker v-model="bday.time"></v-time-picker>
      </v-col>
      <v-col cols="12" md="12">
        <span>Весь день</span>
        <v-checkbox v-model="bday.allDay"></v-checkbox>
      </v-col>
      <v-col cols="12" md="12">
        <span>Каждый год</span>
        <v-checkbox v-model="bday.everyYear"></v-checkbox>
      </v-col>
    </v-row>
     <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="storeData()">Сохранить</v-btn>
        <v-btn color="blue darken-1" text @click="closeModal()">Отмена</v-btn>
      </v-card-actions>
  </div>
</template>

<script>
export default {
  data: () => ({
    bday: {
      name:null,
      description: null,
      time: null,
      allDay: false,
      everyYear: false,
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
                this.$store.dispatch('bdayStore', this.bday);
              }
          },
      computed: {
        showModal() {
          return this.$store.getters.showModal;
        }
      },
}
</script>

<style>

</style>
