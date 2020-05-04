export default {
    state: {
        processing : false,
        error: null
    },
    mutations: {
        set_processing (state, payload) {
            state.processing = payload
        },
        set_error (state, payload) {
            state.error = payload
        },
        clear_error (state) {
            state.error = null
        }
    },
    getters: {
        get_processing: (state)=>state.processing,
        get_error: (state)=>state.error
    },
    actions: {
        increment() {
            axios.post('http://kayaposoft.com/enrico/json/v1.0/?action=getPublicHolidaysForMonth&month=1&year=2014&country=rus')
                .then(function(response){

                });
        }
    }
  }
