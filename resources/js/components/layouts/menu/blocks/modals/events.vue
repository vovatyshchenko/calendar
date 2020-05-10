<template>
  <div>
    <v-row>
      <v-col cols="12" md="12">
        <div class="mb-2">Название*</div>
        <v-text-field
            label="Название"
            outlined
            dense
            v-model="event.name"
            :rules="rules"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Гости</div>
        <v-text-field
            label="Гости"
            outlined
            dense
            v-model="event.guests"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Место располодения</div>
        <v-text-field
            label="Место располодения"
            outlined
            dense
            v-model="event.location"
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Описание*</div>
        <v-text-field
            label="Описание"
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

<style scoped>

</style>