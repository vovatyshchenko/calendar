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
                <select name="select" v-model="route" @click="set_route()" placeholder="День">
                    <option selected value="/">День</option>
                    <option value="/week">Неделя</option>
                    <option value="/month">Месяц</option>
                    <option value="/year">Год</option>
                </select>
            </div>
        </v-app-bar>
    </div>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
            route: '/'
        }),
        methods: {
            change_drawer() {
                this.$store.commit('change_drawer');
                this.drawer=!this.drawer;
            },
            set_route() {
                this.$store.dispatch('set_calendar_page', this.route);
                //this.$router.push({ path: this.$store.getters.calendar_route });  
            },
        },
        computed: {
            current_route() {
                return this.$store.getters.calendar_route;
            },
        },
        watch: {
            current_route(value) {
                if (value != window.location.pathname){
                    this.$router.push({ path: value });  
                }
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/menu.scss";
</style>
