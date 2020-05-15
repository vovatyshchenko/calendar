export default {
    state: {
        processing : false,
        error: null
    },
    mutations: {
        setProcessing (state, payload) {
            state.processing = payload
        },
        setError (state, payload) {
            state.error = payload
        },
        clearError (state) {
            state.error = null
        }
    },
    getters: {
        get_processing: (state)=>state.processing,
        get_error: (state)=>state.error
    }
  }
