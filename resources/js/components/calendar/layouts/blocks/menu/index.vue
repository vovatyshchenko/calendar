<template>
    <v-app>
        <v-app-bar>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Календарь</v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            width="350"
            floating=true
        >

            <v-row justify="center">
                <v-date-picker></v-date-picker>
            </v-row>

        </v-navigation-drawer>
    </v-app>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
            active: true,
        }),
    }
</script>

<style type="sass">

</style>
