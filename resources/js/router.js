import vueRouter from 'vue-router';
import Vue from 'vue';
import Vuelidate from 'vuelidate';

Vue.use(Vuelidate);
Vue.use(vueRouter);

import Index from "./views/index";
import List from "./views/list";
import Element from "./views/element";
import add from "./views/add";

const routes = [
    { path: '/', component: Index },
    { path: '/list', component: List },
    { path: '/people/:id', component: Element },
    { path: '/create', component: add },
    ];

export default new vueRouter({
        mode: "history",
        routes: routes
});