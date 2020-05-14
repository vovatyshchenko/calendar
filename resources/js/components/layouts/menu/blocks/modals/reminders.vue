<template>
    <form ref="createEvent" @submit.prevent="submit">
        <v-spacer></v-spacer>
            <div class="d-flex justify-content-between">
                <v-btn type="submit" color="blue darken-2" dark large>Сохранить</v-btn>
                <v-btn color="blue darken-2" dark large @click="closeModal()">Отмена</v-btn>
            </div>
    </form>
</template>

<script>
export default {
    data () {
        return {

        }
    },
}
</script>

<style>
    
</style>
