export default {
    state: {
        user: {   
            id: null,
            name: null,
            email: null,
            is_authenticated: false
        }
    },
    mutations: {
        set_user(state, payload) {
            state.user.id = payload.id;
            state.user.name = payload.name;
            state.user.email = payload.email;
            state.user.is_authenticated = true;
        },
        un_set_user(state) {
            state.user = {
                id: null,
                name: null,
                email: null,
                is_authenticated: false
            }
          },
    },
    actions: {
        //регистрация пользователя
        register_user ({ commit, dispatch }, user){
            commit("set_processing", true);
            axios.post('/api/user/register', {
                name: user.name,
                email: user.email,
                password: user.password,
                password_confirmation: user.password_confirmation
            })
            .then(responce => {
                commit("clear_error");
                commit("set_processing", false);
                if (responce.data.message) {
                    dispatch('login_user', {
                        email: user.email,
                        password: user.password,
                    });
                }
            })
            .catch(error => {
                commit("set_processing", false);
                commit("set_error", error);
            })
        },
        //логин пользователя
        login_user ({ commit }, user){
            commit("set_processing", true);
            axios.post('/api/user/login', {
                email: user.email,
                password: user.password
            })
            .then(responce => {
                commit("clear_error");
                commit("set_processing", false);
                commit("set_user", responce.data.user);
                if (responce.data.access_token){
                    localStorage.setItem('token', responce.data.access_token);
                }
            })
            .catch(error => {
                commit("set_processing", false);
                commit("set_error", error);
            })
        },
        //выход пользователя
        logout_user ({ commit }){
            localStorage.removeItem('token');
            commit("un_set_user");

        },
        //сохранение пользователя при перезагрузке страницы
        state_change({ commit }) {
            if (localStorage.hasOwnProperty('token')) {
                axios.get('/api/user/getuser')
                .then(responce => {
                    commit("set_user", responce.data);
                })
                .catch(error => {
                    commit("set_error", error.message);
                })
            } 
            else {
                commit("un_set_user");
            }
          }
    },
    getters:{
        is_user_authenticated: state => state.user.is_authenticated,
        user_info: state => state.user
    }
}