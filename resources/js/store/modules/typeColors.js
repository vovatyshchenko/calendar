export default {
    state: {
        textColors: ['#878484', '#f3c81e', '#0c4af3', '#ed5d15', '#70af31', '#0785bd', '#c91880', '#8341ac', '#4ac4a6', '#9d6b47', '#ab9f76', '#ed9963'],
        colors: ['#ededed', '#fff1b8', '#adc3ff', '#ffb996', '#d4ffa8', '#b5e8ff', '#ffa8db', '#e4b8ff', '#bdffef', '#ffd3b3', '#f6ecc9', '#ffd5ba'],

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
        setTypeColors(state, payload) {
            state.typeColors[0].active = payload.birthdays_active;
            state.typeColors[1].active = payload.tasks_active;
            state.typeColors[2].active = payload.activities_active;
            state.typeColors[3].active = payload.holidays_active;

            state.typeColors[0].color = payload.birthdays_color;
            state.typeColors[1].color = payload.tasks_color;
            state.typeColors[2].color = payload.activities_color;
            state.typeColors[3].color = payload.holidays_color;
        }
    },
    actions: {
        getTypeColors(context) {
            axios.get('/type-colors')
                .then(response => {
                    context.commit('setTypeColors', response.data);
                })
                .catch(error => {});
        },
        updateTypeColors(context) {
            let data = {};
            data.birthdays_active = context.getters.typeColors[0].active;
            data.tasks_active = context.getters.typeColors[1].active;
            data.activities_active = context.getters.typeColors[2].active;
            data.holidays_active = context.getters.typeColors[3].active;

            data.birthdays_color = context.getters.typeColors[0].color;
            data.tasks_color = context.getters.typeColors[1].color;
            data.activities_color = context.getters.typeColors[2].color;
            data.holidays_color = context.getters.typeColors[3].color;

            axios.put('/update-type-colors', data)
                .then(responce => {})
                .catch(error => {})
        },
    },
    getters:{
        typeColors (state) {
            return state.typeColors;
        },
        colors (state) {
            return state.colors;
        },
        textColors (state) {
            return state.textColors;
        },
    }
}
