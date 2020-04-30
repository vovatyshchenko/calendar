<template>
    <div>
        <v-navigation-drawer
            v-model="drawer"
            app
            :fixed="true"
            temporary
            class="hidden-md-and-up"
        >
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title>ToDo LIST</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
            <v-list dense>
                <v-list-item link 
                    v-for="(item, index) in nav_items"
                    :key="index"
                    :to="item.route"
                >
                    <v-list-item-action>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-app-bar
            app
            color="primary"
            dark
        >
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
                class="hidden-md-and-up"
            />
            <v-toolbar-title>ToDo LIST</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text v-for="(item, index) in nav_items"
                :key="index"
                :to="item.route"
                class="hidden-sm-and-down"
            >
                <v-icon v-html="item.icon"></v-icon>
                {{ item.title }}
            </v-btn>
        </v-app-bar>
    </div>
</template>

<script>
  export default {
    data: () => ({
      drawer: false,
    }),
    computed: {
      nav_items() {
        return [
          {
            icon: 'mdi-home',
            title: 'HOME',
            route: '/'
          },
          {
            icon: 'mdi-mail',
            title: 'ABOUT',
            route: '/about'
          }
        ];
      }
    },
  }
</script>

<style>

</style>