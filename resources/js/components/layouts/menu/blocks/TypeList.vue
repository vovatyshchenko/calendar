<template>
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
</template>

<script>
    export default {
        data: () => ({
            items: [
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
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/type_list.scss";
</style>
