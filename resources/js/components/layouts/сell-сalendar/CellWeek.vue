<template>
    <div class="day-event">
        <span>text</span>
    </div>
</template>

<script>

    export default {
        props:['date'],
        name: "CellWeek"
    }
</script>

<style lang="scss" scoped>
    @import "./resources/sass/calendar/day.scss";
</style>
