<template>
    <div class="calendar-menu">
        <v-app-bar
            height="75"
            color="#fafafa"
            flat
        >
            <v-app-bar-nav-icon @click="change_drawer()"></v-app-bar-nav-icon>
            <v-toolbar-title>
                <span class="menu-title">Календарь</span>
            </v-toolbar-title>
            <div class="menu-today-block">
                <button class="menu-today-link" @click="today()" v-ripple>
                    <span>Сегодня</span>
                </button>
            </div>
            <div class="arrows-block">
                <button @click="minus_date()" class="arrow-left" v-ripple>
                    <v-icon>mdi-arrow-left</v-icon>
                </button>
                <button @click="plus_date()" class="arrow-right" v-ripple>
                    <v-icon>mdi-arrow-right</v-icon>
                </button>
            </div>
            <div class="menu-date-info">
                <span class="menu-date">{{display_date()}}</span>
            </div>
            <search></search>
            <div class="select-calendar">
                <select name="select" v-model="route" @click="set_route()" data-icon="mdi-arrow-left">
                    <option value="/">Месяц</option>
                    <option value="/day">День</option>
                    <option value="/week">Неделя</option>
                    <option value="/year">Год</option>
                    <option v-if="this.current_route == '/search-result'" value="/search-result">Поиск</option>
                </select>
            </div>
        </v-app-bar>
    </div>
</template>

<script>
    export default {
        data: () => ({
            drawer: false,
            menuDate: 0,
            route: window.location.pathname,
            year: new Date().getFullYear(),
        }),
        methods: {
            getDayRoute(value) {
                this.route = value;
            },
            today() {
                this.$store.commit('setDate', new Date);
                this.$store.commit('setDatePicker', new Date);
                if (window.location.pathname != '/day'){
                    this.$eventBus.$emit('currentRoute', '/day');
                    this.$store.commit('set_route', '/day');
                }
            },
            change_drawer() {
                this.$store.commit('changeDrawer');
                this.drawer = !this.drawer;
            },
            set_route() {
                this.$store.dispatch('set_calendar_page', this.route);
            },
            minus_date() {
                let fullDate = this.$store.getters.menuDate;
                if (window.location.pathname == '/day') {
                    fullDate.setDate(fullDate.getDate() - 1);
                    this.$store.commit('setEvents', {});
                } else if (window.location.pathname == '/year') {
                    fullDate.setFullYear(fullDate.getFullYear() - 1);
                    this.$store.commit('setEvents', {});
                    this.$store.dispatch('yearData');
                } else if (window.location.pathname == '/week') {
                    fullDate.setDate(fullDate.getDate() - 7);
                    this.$store.commit('setEvents', {});
                } else {
                    fullDate.setMonth(fullDate.getMonth() - 1);
                    this.$store.commit('setEvents', {});

                }
                this.$store.commit('setDate', fullDate);
                this.$store.commit('setCurrentYear', fullDate);
                this.year = this.$store.getters.year;

            },
            plus_date() {
                let fullDate = this.$store.getters.menuDate;
                if (window.location.pathname == '/day') {
                    fullDate.setDate(fullDate.getDate() + 1);
                    this.$store.commit('setEvents', {});
                } else if (window.location.pathname == '/year') {
                    fullDate.setFullYear(fullDate.getFullYear() + 1);
                    this.$store.commit('setEvents', {});
                    this.$store.dispatch('yearData');
                } else if (window.location.pathname == '/week') {
                    this.$store.commit('setEvents', {});
                    fullDate.setDate(fullDate.getDate() + 7);
                } else {
                    fullDate.setMonth(fullDate.getMonth() + 1);
                    this.$store.commit('setEvents', {});
                }
                this.$store.commit('setDate', fullDate);

                this.$store.commit('setCurrentYear', fullDate);
                this.year = this.$store.getters.year;
            },
            display_date() {
                if (window.location.pathname == '/day') {
                    return this.$store.getters.menuDate.getDate() + '.' + (this.$store.getters.menuDate.getMonth() + 1) + '.' + this.$store.getters.menuDate.getFullYear();
                }
                if (window.location.pathname == '/year') {
                    return this.$store.getters.menuDate.getFullYear();
                }
                let months = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"];
                return months[this.$store.getters.menuDate.getMonth()] + ' ' + this.$store.getters.menuDate.getFullYear();
            },
            set_date() {
                let fullDate = new Date();
                this.$store.commit('setDate', fullDate);
            }
        },
        computed: {
            isSearched() {
                return this.$store.getters.isSearched;
            },
            current_route() {
                return this.$store.getters.calendar_route;
            },
        },
        created() {
            this.$store.dispatch('getHolidays', {year: this.year});
            this.$eventBus.$on('currentRoute', this.getDayRoute);
        },
        beforeDestroy() {
            this.$eventBus.$off('currentRoute');
        },
        watch: {
            current_route(value) {
                if (value != window.location.pathname) {
                    this.$router.push({path: value});
                }
            },
            year() {
                this.$store.dispatch('getHolidays', {year: this.year});
            },
            /*isSearched(value) {
                if (value === true) {
                    if (window.location.pathname != '/search-result') {
                        this.$router.push('search-result');
                    }
                    this.$store.commit('setStatusSearched',false);
                }
            },*/
        },
    }

</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/menu.scss";
</style>
