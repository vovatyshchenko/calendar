<template>
<div>
    <div v-for="month in 12">
    <cell-year :month="month" :year="year"></cell-year>
    </div>
    <button @click="year++">Добавить</button>
    <button @click="year--">Убрать</button>
</div>
</template>

<script>
    export default {
        name: "Year",
        data(){
            return{
                year:2020
            }
        },
        created() {
            let nowDate = new Date();
            let currentYear = nowDate.getFullYear();
            this.year=currentYear;

        }
    }
</script>

<style scoped>

</style>
