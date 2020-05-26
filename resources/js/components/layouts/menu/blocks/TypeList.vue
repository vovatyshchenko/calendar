<template>
    <div class="row">
        <div class="col-12 d-flex flex-column align-items-center">
            <button @click="show=!show" class="btn">Мои календари</button>
            <div v-if="show" v-for="(item, index) in items" class="d-flex flex-column align-items-center type-list">
                <div @click="showColorPicker(index)" class="btn sub d-flex">
                    <input type="checkbox" class="check" :checked="typeEvent[index].active" @click.stop="setShowType(index)">
                    <span>{{ item }}</span>
                </div>
                <div v-if="activePicker==index && colorPicker[activePicker]" class="color">
                    <div class="color-info">
                        <span>Показывать только этот</span>
                    </div>
                    <div class="color__picker d-flex flex-wrap justify-content-center px-2 pb-2">
                        <div
                            @click="changeActiveColor(idColor, index)"
                            :class="[{active: !(idColor==typeEvent[index].color)}, colorItemPicker]"
                            :style="{'background-color': color}"
                            v-for="(color, idColor) in colors">
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
            colorItemPicker: 'color__picker__item',
            show: false,
            showColor: [false, false, false, false],
            activePicker: null
        }),
        computed: {
            typeEvent() {
                return this.$store.getters.typeColors;
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
                this.$store.dispatch('updateTypeColors');
            },
            changeActiveColor(index, type) {
                this.$store.commit('changeTypeColors', {'type':type, 'number':index});
                this.$store.dispatch('updateTypeColors');
            },
        },
        created() {
            this.colors = this.$store.getters.textColors;
        },
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/menu/type_list.scss";
</style>
