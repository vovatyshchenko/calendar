
export default {
    data(){
        return{

        }
    },
    computed:{

    },
    watch: {
        status(value) {
            if (value === true) {
                this.$toaster.success('Данные успешно сохранены.');
                this.$store.commit("setStatus", false);
                this.$store.commit('changeShowModal');
            }
        },
        statusUpdated(value) {
            if (value === true) {
                this.$toaster.success('Данные успешно изменены');
                this.$store.commit("setStatusUpdated", false);
                this.$store.commit('changeShowModal');
            }
        },
    }
}
