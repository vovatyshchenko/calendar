<template>
    <v-app id="inspire">
        <user-block></user-block>
        <div>
            <v-app>
                <menu-calendar></menu-calendar>
                <div class="content-block">
                    <sidebar-calendar v-if="drawer"></sidebar-calendar>
                    <div align="center" class="calendar-block">
                        <v-content>
                            <router-view></router-view>
                        </v-content>
                    </div>
                </div>
            </v-app>
        </div>
    </v-app>
</template>

<script>
export default {
    data: () => ({}),
    computed: {
        drawer() {
            return this.$store.getters.drawer;
        }
    },
}
</script>

<style lang="scss" scoped>
    @import "./resources/sass/main.scss";
</style>
