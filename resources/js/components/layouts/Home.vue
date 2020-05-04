<template>
  <div>
    <div class="d-flex row justify-content-end">
      <div class="col-8">
        <calendar-year></calendar-year>
      </div>
    </div>
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
