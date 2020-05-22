import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Main from "../pages/Main/index";
import SingIn from "../pages/SingIn/index";
import SingUp from "../pages/SingUp/index";
import PersonalPage from "../pages/PersonalPage/index";

export default new VueRouter({
    routes: [
        {
            path: "/",
            component:  Main
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
            component:  PersonalPage
        }
    ]
});



