<template>
  <div>
    <v-row>
      <v-col cols="12" md="12">
        <div class="mb-2">Название*</div>
        <v-text-field
            label="Название"
            outlined
            dense
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Гости</div>
        <v-text-field
            label="Гости"
            outlined
            dense
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Место располодения</div>
        <v-text-field
            label="Место располодения"
            outlined
            dense
          ></v-text-field>
      </v-col>
      <v-col cols="12" md="12">
        <div class="mb-2">Описание*</div>
        <v-text-field
            label="Описание"
            outlined
            dense
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
  </div>
</template>

<script>
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
   }),
}
</script>

<style scoped>

</style>