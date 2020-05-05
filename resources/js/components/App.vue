<template>
  <v-app id="inspire">
    <nav-block></nav-block>
        <user-block></user-block>

              <!--<div class="calendar-menu">
                  <v-app-bar
                      height="75"
                      color="#E5E5E5"
                      flat
                      class="calendar-menu"
                  >
                      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
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
              <div class="content-block">
                  <v-navigation-drawer
                      v-model="drawer"
                      width="370"
                      floating
                      class="bg-calendar calendar-sidebar"
                  >
                      <v-btn width="130" height="50" class="create-btn menu-btn" color="#1875F0" depressed>Создать</v-btn>
                      <div class="side-data-picker">
<!--                          <div class="side-data-picker-header">-->
<!--                              August 2020-->
<!--                          </div>-->
<!--                          <div class="side-data-picker-body">-->


<!--                          </div>-->

                          <!--<v-date-picker v-model="picker"></v-date-picker>
                      </div>
                      <div class="row">
                          <div class="col-12 d-flex flex-column align-items-center">
                              <button @click="show=!show" class="btn">Мои календари</button>
                              <div @click="show_color=!show_color" v-if="show" v-for="item in items" class="btn sub"><input type="checkbox" class="check">{{ item }}</div>
                              <div v-if="show_color" class="color">Показывать только этот<hr>
                                  <div class="color__picker d-flex flex-wrap justify-content-center px-2 pb-2">
                                      <div class="color__picker__item color1"></div>
                                      <div class="color__picker__item color2"></div>
                                      <div class="color__picker__item color3"></div>
                                      <div class="color__picker__item color4"></div>
                                      <div class="color__picker__item color5"></div>
                                      <div class="color__picker__item color6"></div>
                                      <div class="color__picker__item color7"></div>
                                      <div class="color__picker__item color8"></div>
                                      <div class="color__picker__item color9"></div>
                                      <div class="color__picker__item color10"></div>
                                      <div class="color__picker__item color11"></div>
                                      <div @click="isActive=!isActive" v-bind:class="{ active: isActive }" class="color__picker__item color12"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </v-navigation-drawer>-->


                  <v-row align="center" justify="end">
                      <v-col>
                          <v-content>
                              <router-view></router-view>
                          </v-content>
                      </v-col>
                  </v-row>
    <footer-block></footer-block>
  </v-app>

</template>

<script>
  export default {
    data: () => ({
        drawer: false,
        items: ['День', 'Неделя', 'Месяц', 'Год'],
        tems: [
            'Дни рождения',
            'Задачи',
            'Мероприятие',
            'Напоминания',
            'Праздники Украины',
        ],
        show: false,
        show_color: false,
        isActive: true,
        picker: new Date().toISOString().substr(0, 10),
    }),
    /*created() {
      if (localStorage.hasOwnProperty('token')){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
        this.$store.dispatch("state_change");
      }
    }*/
  }
</script>

<style scoped>
    .content-block {
        display: flex;
        background-color: #E5E5E5;
    }
    .bg-calendar .theme--light.v-navigation-drawer{
        background-color: #E5E5E5 !important;
    }
    .calendar-menu {
        border-top: 3px solid #C4C4C4;
        border-bottom: 3px solid #C4C4C4;
    }
    .calendar-sidebar {
        border-left: 3px solid #C4C4C4;
        padding-left: 22px;
        padding-top: 3px;
    }
    .menu-btn {
        box-sizing: border-box;
        border-radius: 4px;
        border: 2px solid #F5F5F5;
        text-align: center;
        text-transform: uppercase;
    }
    .create-btn {
        color: #fff;
        font-weight: 900;
        line-height: 50px;
        font-size: 12px;
    }
    .side-data-picker {
        margin: 5px 0 65px;
        background: #FFFFFF;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
        border-radius: 6px;
        width: 260px;
        height: 330px;
    }
    .side-data-picker-header {
        height: 55px;
        border-bottom: 3px solid #F5F5F5;
        text-align: center;
        font-weight: 500;
        font-size: 14px;
        line-height: 60px;
        color: #666666;
    }
    .menu-info {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        max-width: 1100px;
    }
    .today-btn {
        font-weight: 500;
        font-size: 14px;
        line-height: 60px;
        color: #666666;
    }
    .arrows-block {
        height: 40px;
    }
    .menu-date {
        font-weight: 500;
        font-size: 14px;
        line-height: 60px;
        color: #666666;
    }
    .menu-search {
        width: 100%;
        max-width: 435px;
        height: 50px;
        background: #FFFFFF;
        border: 2px solid #F5F5F5;
        box-sizing: border-box;
        border-radius: 4px;
    }
    .select-calendar {
        border-left: 3px solid #C4C4C4;
        width: 100%;
        max-width: 340px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-left: auto;
        height: 100%;
    }
    .select-calendar select {
        width: 130px;
        height: 50px;
        background: #FFFFFF;
        border: 2px solid #F5F5F5;
        box-sizing: border-box;
        border-radius: 4px;
    }
    body {
        margin: 0;
        background-color: #fafafa;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        font-size: 15px;
        line-height: 30px;
    }
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }
    .btn  {
        position:relative;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        font-size: 15px;
        line-height: 30px;
        text-align: left;
        padding: 3px;
        height: 100%;
        width: 100%;
        border: none;
        background: #fff;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.05);
        border-radius: 6px;
        outline: none;
        max-height: 36px;
        max-width: 255px;
        border: none !important;
        outline: none !important;
    }
    .btn:focus,
    .btn:active {
        outline: none !important;
    }
    .btn:after {
        content: "";
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: transparent;
        border-right: 2px solid #D8D8D8;
        border-bottom: 2px solid #D8D8D8;
        transform: rotate(45deg);
        top: 10px;
        left: 220px;
        z-index: 1;
    }
    .check {
        margin-right: 22px;
        width: 30px;
        height: 20px;
    }
    .btn:hover {
        color: #B3B3B3;
    }
    .btn.active {
        color: #B3B3B3;
    }
    .sub {
        background-color: #fafafa;
        border-radius: 0;
    }
    hr {
        display: block;
        width: 100%;
        height: 2px;
        border: 0;
        margin-bottom: 40px;
        background-color: #DADADA;
    }
    .color {
        background: linear-gradient(180deg, #FFFFFF 0%, rgba(255, 255, 255, 0) 100%), #F5F5F5;
        border: 1px solid #F5F5F5;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.54);
        border-radius: 6px;
        width: 256px;
        text-align: center;
    }
    .color__picker__item {
        position: relative;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        margin: 7px;
    }
    .color__picker__item:after {
        content: "";
        position: absolute;
        width: 6px;
        height: 10px;
        background-color: transparent;
        border-right: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: rotate(45deg);
        top: 6px;
        left: 9px;
        z-index: 1;
    }
    .color__picker__item.active:after {
        opacity: 0;
    }
    .color__picker__item:hover {
        cursor: pointer;
    }
    .color1 {
        background-color: #fcfcfc;
    }
    .color2 {
        background-color: #f3c81e;
    }
    .color3 {
        background-color: #0c4af3;
    }
    .color4 {
        background-color: #ed5d15;
    }
    .color5 {
        background-color: #70af31;
    }
    .color6 {
        background-color: #0785bd;
    }
    .color7 {
        background-color: #c91880;
    }
    .color8 {
        background-color: #8341ac;
    }
    .color9 {
        background-color: #4ac4a6;
    }
    .color10 {
        background-color: #9d6b47;
    }
    .color11 {
        background-color: #f6ecc9;
    }
    .color12 {
        background-color: #ed9963;
    }
</style>
