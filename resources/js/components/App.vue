<template>
  <v-app id="inspire">
    <nav-block></nav-block>
      <v-content>
        <v-container class="fill-height">
          <v-row align="center" justify="center">
            <v-col class="text-center">
              <router-view></router-view>
            </v-col>
          </v-row>
        </v-container>
      </v-content>
    <footer-block></footer-block> 
  </v-app>
</template>

<script>
  export default {
    data: () => ({}),
  }
</script>