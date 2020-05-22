import Vue from 'vue';
import Vuex from 'vuex';
import User from './Modules/User/index';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        user: User
        //menu
    }
    //strict: process.env.MIX_APP_ENV === 'local'
})
