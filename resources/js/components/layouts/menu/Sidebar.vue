<template>
    <div>
        <v-navigation-drawer
            :value="drawer"
            width="290"
            floating
            class="bg-calendar calendar-sidebar"
        >
            <button class="create-btn" @click="change_show_modal()" v-ripple>Создать</button>
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
