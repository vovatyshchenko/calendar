<template>
    <div>
        <v-navigation-drawer
            :value="drawer"
            width="290"
            floating
            class="bg-calendar calendar-sidebar"
        >
            <v-btn width="130" height="50" class="create-btn menu-btn" color="#1875F0" depressed>Создать</v-btn>
            <div class="side-data-picker">
                <div class="side-data-picker-header">
                    August 2020
                </div>
                <div class="side-data-picker-body">

                </div>
            </div>
            <type-list></type-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
    export default {
        computed: {
            drawer() {
                return this.$store.getters.drawer;
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/sidebar.scss";
</style>
