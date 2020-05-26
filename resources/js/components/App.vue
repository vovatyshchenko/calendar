<template>
    <div>
        <nav-block></nav-block>
    </div>
</template>
<script>
export default {
    data: () => ({ }),
    created() {
        this.$store.dispatch('getTypeColors');
    }
}
</script>

<style lang="scss">
    @import "./resources/sass/main.scss";
</style>
