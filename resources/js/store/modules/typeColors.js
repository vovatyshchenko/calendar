export default {
    state: {
        colors: ['#D8D8D8', '#f3c81e', '#0c4af3', '#ed5d15', '#70af31', '#0785bd', '#c91880', '#8341ac', '#4ac4a6', '#9d6b47', '#f6ecc9', '#ed9963'],
        typeColors: [
            {'active':true, 'color': 0}, //birthdays
            {'active':false, 'color': 0}, //tasks
            {'active':false, 'color': 0}, //activities
            {'active':true, 'color': 0}, //holidays
        ]
    },
    mutations: {
        changeTypeEvent(state, count) {
            Vue.set(state.typeColors[count], 'active', !state.typeColors[count].active);
        },
        changeTypeColors(state, color) {
            Vue.set(state.typeColors[color.type], 'color', color.number);
        },

    },
    getters:{
        typeColors (state) {
            return state.typeColors;
        },
        colors (state) {
            return state.colors;
        },
    }
}
