<template>
  <div>
    <v-snackbar
      v-model="is_user_authenticated"
      bottom=true
      color=info
      multi-line=true
      timeout=3000
    >
      Добро пожаловать {{user_info.name}}
    </v-snackbar>
    <h1>HOME PAGE</h1>
  </div>
</template>

<script>
export default {
  data: () => ({}),
  computed: {
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
  }
} 
</script>

