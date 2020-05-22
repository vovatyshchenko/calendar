<template>
    <div class="row">
        <div class="col-12 d-flex flex-column align-items-center">
            <!--            <button @click="show=!show" class="btn">Мои календари</button>-->
            <!--            <div @click="showColorPicker(index)" v-if="show" v-for="(item, index) in items" class="btn sub">-->
            <!--                <input type="checkbox" class="check" :checked="typeEvent[index]" @click="setShowType(index)">{{ item }}-->
            <!--            </div>-->
            <!--            <div v-if="showColor[index]" class="color">Показывать только этот<hr>-->
            <!--                <div class="color__picker d-flex flex-wrap justify-content-center px-2 pb-2">-->
            <!--                    <div @click="changeActiveColor(index)" :class="[{active: color.active}, color.class, colorItemPicker]" v-for="(color, index) in colors"></div>-->
            <!--                </div>-->
            <!--            </div>-->

            <button @click="show=!show" class="btn">Мои календари</button>
            <div v-if="show" v-for="(item, index) in items" class="d-flex flex-column align-items-center type-list">
                <div @click="showColorPicker(index)" class="btn sub d-flex">
                    <input type="checkbox" class="check" :checked="typeEvent[index]" @click.stop="setShowType(index)">
                    <span>{{ item }}</span>
                </div>
                <div v-if="activePicker==index && colorPicker[activePicker]" class="color">
                    <div class="color-info">
                        <span>Показывать только этот</span>
                    </div>
                    <div class="color__picker d-flex flex-wrap justify-content-center px-2 pb-2">
                        <div
                            @click="changeActiveColor(id, index)"
                            :class="[{active: true}, colorItemPicker]"
                            :style="{'background-color': color.value}"
                            v-for="(color, id) in typeColors[index]">
                        </div>
                    </div>
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
                'Праздники Украины',
            ],
            colors: [],
            typeColors: [],
            colorItemPicker: 'color__picker__item',
            show: false,
            showColor: [false, false, false, false],
            activePicker: null

        }),
        computed: {
            typeEvent() {
                return this.$store.getters.typeEvent;
            },
            colorPicker() {
                return this.showColor;
            },
        },
        methods: {
            showColorPicker(index) {
                for (let i = 0; i<this.showColor.length; i++) {
                    if (i==index) {
                        this.$set(this.showColor, i, !this.showColor[i]);
                        this.activePicker=index;
                    } else {
                        this.$set(this.showColor, i, false);
                    }
                }
            },
            setShowType(index){
                this.$store.commit('changeTypeEvent', index);
            },
            changeActiveColor(index, type) {
                for (let i = 0; i<this.typeColors[type].length; i++) {
                    if (i==index) {
                        this.$set(this.typeColors[type][i], 'active', false);
                    } else {
                        this.$set(this.typeColors[type][i], 'active', true);
                    }
                }
                this.$store.commit('changeTypeColors', [type, index]);
                console.log(this.typeColors[type]);
            },
        },
        created() {
            let colors = [];
            let type = this.$store.getters.typeColors;
            this.typeColors = [];

            for (let i=0; i<this.$store.getters.typeColors.length; i++) {
                for (let colorIndex=0; colorIndex<this.$store.getters.colors.length; colorIndex++) {
                    colors[colorIndex]={};
                    colors[colorIndex].value = this.$store.getters.colors[colorIndex];
                    if (colorIndex==type[i]) {
                        colors[colorIndex].active = false;
                    } else {
                        colors[colorIndex].active = true;
                    }
                }
                this.typeColors[i] = colors;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/type_list.scss";
</style>
