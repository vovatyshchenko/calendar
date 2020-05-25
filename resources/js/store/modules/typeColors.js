export default {
    state: {
        colors: ['#D8D8D8', '#f3c81e', '#0c4af3', '#ed5d15', '#70af31', '#0785bd', '#c91880', '#8341ac', '#4ac4a6', '#9d6b47', '#f6ecc9', '#ed9963'],
        typeEvent: [
            true, //birthdays
            false, //tasks
            false, //activities
            true //Holidays
        ],
        typeColors: [
            0, //birthdays
            0, //tasks
            0, //activities
            0  //Holidays
        ],
    },
    mutations: {
        changeTypeEvent(state, count) {
            Vue.set(state.typeEvent, count, !state.typeEvent[count]);
        },


        changeTypeColors(state, color) {
            Vue.set(state.typeColors, color[0], color[1]);
            console.log(state.typeColors);
        },


    },
    getters:{
        typeEvent (state) {
            return state.typeEvent;
        },
        typeColors (state) {
            return state.typeColors;
        },
        colors (state) {
            return state.colors;
        },
    }
}
