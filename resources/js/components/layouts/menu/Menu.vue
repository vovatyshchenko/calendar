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
<!--                    <router-link to="/">-->
                        <v-btn @click="minus_date()" depressed>
                            <v-icon left>mdi-arrow-left</v-icon>
                        </v-btn>
<!--                    </router-link>-->
<!--                    <router-link to="/">-->
                        <v-btn @click="plus_date()" depressed>
                            <v-icon right>mdi-arrow-right</v-icon>
                        </v-btn>
<!--                    </router-link>-->
                </div>
                <span class="menu-date">{{display_date()}}</span>
                <div class="menu-search">
                    Поиск
                </div>
            </div>
            <div class="select-calendar">
                <select name="select" v-model="route" @click="set_route()" placeholder="День">
                    <option selected value="/day">День</option>
                    <option value="/week">Неделя</option>
                    <option value="/">Месяц</option>
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
            menuDate: 0,
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
            minus_date() {
                let fullDate=this.$store.getters.menuDate;
                if (window.location.pathname == '/day') {
                    fullDate.setDate(fullDate.getDate()-1);
                } else if (window.location.pathname == '/year') {
                    fullDate.setFullYear(fullDate.getFullYear()-1);
                } else if (window.location.pathname == '/') {
                    fullDate.setMonth(fullDate.getMonth()-1);
                }
                this.$store.commit('set_date', fullDate);
                console.log(this.$store.getters.menuDate);
            },
            plus_date() {
                let fullDate=this.$store.getters.menuDate;
                if (window.location.pathname == '/day') {
                    fullDate.setDate(fullDate.getDate()+1);
                } else if (window.location.pathname == '/year') {
                    fullDate.setFullYear(fullDate.getFullYear()+1);
                } else {
                    fullDate.setMonth(fullDate.getMonth()+1);
                }
                this.$store.commit('set_date', fullDate);
                console.log(this.$store.getters.menuDate);
            },
            display_date() {
                if (window.location.pathname == '/day') {
                    return this.$store.getters.menuDate.getDate()+'.'+(this.$store.getters.menuDate.getMonth()+1)+'.'+this.$store.getters.menuDate.getFullYear();
                }
                if (window.location.pathname == '/year') {
                    return this.$store.getters.menuDate.getFullYear();
                }
                let months=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
                return months[this.$store.getters.menuDate.getMonth()]+' '+this.$store.getters.menuDate.getFullYear();
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
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/menu.scss";
</style>
