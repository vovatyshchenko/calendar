
export default {
    data(){
        return{

        }
    },
    computed:{
       statusUpdated(){
            return this.$store.getters.getStatusUpdated;
        }
    },
    watch: {
        status(value) {
            if (value === true) {
                this.$toaster.success('Данные успешно сохранены.');
                this.$store.commit('changeShowModal');
                this.$store.commit("setStatus", false);

            }
        },
        statusUpdated(value) {
            if (value === true) {
                this.$toaster.success('Данные успешно изменены');
                this.$store.commit('changeShowModal');
                this.$store.commit("setStatusUpdated", false);
            }
        },
    }
}
