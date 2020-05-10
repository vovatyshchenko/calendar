<template>
    <div>
        <v-navigation-drawer
            :value="drawer"
            width="290"
            floating
            class="bg-calendar calendar-sidebar"
        >
            <v-btn width="130" height="50" class="create-btn menu-btn" color="#1875F0" depressed @click="change_show_modal()">Создать</v-btn>
            <mini-calendar></mini-calendar>
            <type-list></type-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
    export default {
        data: () => ({
            showModal: false
        }),
        methods: {
            change_show_modal() {
                this.$store.commit('changeShowModal');
                this.showModal=!this.showModal;
            },
        },
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
