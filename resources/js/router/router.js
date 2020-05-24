import Vue from 'vue'
import store from '../store/index';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Main from "../pages/Main/index";
import SingIn from "../pages/SingIn/index";
import SingUp from "../pages/SingUp/index";
import PersonalPage from "../pages/PersonalPage/index";

const isAuthenticated = (to, from, next) => {
    if (store.getters["user/isAuthenticated"]) { //user.
        next();
        return;
    }
    next("/sing-in");
};

export default new VueRouter({
    routes: [
        {
            path: "/",
            component:  Main,
            beforeEnter: isAuthenticated
        },
        {
            name: "sing-in",
            path: "/sing-in",
            component:  SingIn
        },
        {
            path: "/sing-up",
            component:  SingUp
        },
        {
            name: "personal",
            path: "/personal",
            component:  PersonalPage,
            beforeEnter: isAuthenticated
        }
    ]
});



