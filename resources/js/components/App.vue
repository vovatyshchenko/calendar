<template>
    <v-app id="inspire">
        <div>
            <menu-calendar></menu-calendar>
            <div class="content-block">
                <sidebar-calendar v-if="drawer"></sidebar-calendar>
                <div align="center" class="calendar-block">
                    <create-modal></create-modal>
                    <v-content>
                        <router-view></router-view>
                    </v-content>
                </div>
            </div>
        </div>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        showModal: true,
    }),
    computed: {
        drawer() {
            return this.$store.getters.drawer;
        }
    },
    methods: {

    }
}
</script>

<style lang="scss" scoped>
    @import "./resources/sass/main.scss";
</style>
