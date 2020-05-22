import * as type from './types.js'

export default {
    namespaced: true,

    state: {
        token: localStorage.getItem('user-token') || '',
    },

    getters: {
        isAuthenticated : state => {
            return state.token;
        }
    },

    mutations: {
        [type.AUTHENTICATE]: (state, token) => {
            state.token = token;
            localStorage.setItem('user-token', token);
        },

        [type.LOG_OUT]: (state, token) => {
            localStorage.removeItem("user-token");
            state.token = '';
        },
    },
}

