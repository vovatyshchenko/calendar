<template>
  <div>  
    <v-row align="center">
      <v-col>
        <calendar-year></calendar-year>
          <year></year>
      </v-col>

        <calendar-month></calendar-month>
        <cell-month></cell-month>

        <router-link active-class="font-bold" to="/month">Перейти на месяц</router-link>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({}),
  /*computed: {},
    is_user_authenticated() {
      return this.$store.getters.is_user_authenticated;
    },
    user_info() {
      return this.$store.getters.user_info;
    },
  },
  watch: {
    is_user_authenticated(value) {
      if (value === false) this.$router.push({ path: "/login" });
    }
  }*/
}
</script>

<style>

</style>
