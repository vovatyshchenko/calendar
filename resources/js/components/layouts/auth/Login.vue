<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <v-spacer></v-spacer>
          <v-btn
            text
            v-for="(item, index) in nav_items"
            :key="index"
            :to="item.route"
            :disabled="processing"
          >{{ item.title }}</v-btn>
        </v-card-title>
        <v-card-text>
          <v-progress-linear :active="processing" indeterminate height="5" color="red darken-1"></v-progress-linear>
          <v-alert :value="error" type="warning">{{ error }}</v-alert>
          <v-container>
            <v-form v-model="valid">
              <v-text-field
                v-model="user.email"
                label="E-Mail"
                name="login"
                prepend-icon="person"
                type="text"
                required
                :rules="erules"
              />
              <v-text-field
                v-model="user.password"
                id="password"
                label="Пароль"
                name="password"
                prepend-icon="lock"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :type="show ? 'text' : 'password'"
                required
                :rules="prules"
                @click:append="show = !show"
              />
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click.prevent="login"
            :disabled="processing || !valid"
          >Войти</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {
  data: () => ({
    user: {
      email: null,
      password: null
    },
    dialog: true,
    valid: false,
    show: false,
    erules: [
      v => !!v || "Пожалуйста, введите email",
      v =>
        /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/.test(
          v
        ) || "Неверный email"
    ],
    prules: [
      v => !!v || "Пожалуйста, введите пароль",
      v =>
        (v && v.length >= 8) ||
        "пароль слишком короткий - должен быть более 8 символов"
    ]
  }),
  methods: {
    login() {
      this.$store.dispatch("login_user", this.user);
    }
  },
  computed: {
    error() {
      return this.$store.getters.get_error;
    },
    processing() {
      return this.$store.getters.get_processing;
    },
    is_user_authenticated() {
      return this.$store.getters.is_user_authenticated;
    },
    nav_items() {
      return [
        {
          icon: "mdi-home",
          title: "Войти",
          route: "/login"
        },
        {
          icon: "mdi-home",
          title: "Зарегистрироваться",
          route: "/register"
        }
      ];
    }
  },
  watch: {
    is_user_authenticated(value) {
      if (value === true) this.$router.push({ path: "/" });
    }
  }
};
</script>