<template>
    <div class="calendar-menu">
        <v-app-bar
            height="75"
            color="#fafafa"
            flat
        >
            <v-app-bar-nav-icon @click="change_drawer()"></v-app-bar-nav-icon>
            <v-toolbar-title>Календарь</v-toolbar-title>
            <div class="menu-info">
                <v-btn width="130" height="50" class="today-btn menu-btn" color="#fff" depressed>Сегодня</v-btn>
                <div class="arrows-block">
                    <v-btn depressed>
                        <v-icon left>mdi-arrow-left</v-icon>
                    </v-btn>
                    <v-btn depressed>
                        <v-icon right>mdi-arrow-right</v-icon>
                    </v-btn>
                </div>
                <span class="menu-date">Апрель 2020</span>
                <div class="menu-search">
                    Поиск
                </div>
            </div>
            <div class="select-calendar">
                <select name="select">
                    <option value="value1" selected>День</option>
                    <option value="value2">Неделя</option>
                    <option value="value3">Месяц</option>
                    <option value="value4">Год</option>
                </select>
            </div>
        </v-app-bar>
    </div>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
        }),
        methods: {
            change_drawer() {
                this.$store.commit('change_drawer');
                this.drawer=!this.drawer;
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/menu.scss";
</style>
