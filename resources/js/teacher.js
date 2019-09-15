/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require("./bootstrap");

import VCalendar from "v-calendar";

window.Vue = require("vue");

import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
    {
        path: "/teacher",
        component: require("./components/SchedulePage.vue").default
    },
    {
        path: "/teacher/groups",
        component: require("./components/GroupsPage.vue").default
    }
];

const router = new VueRouter({
    routes: routes, // short for `routes: routes`
    base: "/",
    history: true,
    mode: "history"
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component("example", require("./components/Example.vue").default);

Vue.component(
    "schedule-page",
    require("./components/SchedulePage.vue").default
);

Vue.component("schedule", require("./components/Schedule.vue").default);
Vue.component(
    "filter-sessions",
    require("./components/filterSessions.vue").default
);
Vue.component(
    "groups-students",
    require("./components/GroupsStudents.vue").default
);

Vue.component(
    "add-simple-session",
    require("./components/AddSimpleSession.vue").default
);
Vue.component(
    "add-fixed-session",
    require("./components/AddFixedSession.vue").default
);

Vue.component("add-group", require("./components/AddGroup.vue").default);
Vue.component(
    "vue-timepicker",
    require("vue2-timepicker/dist/VueTimepicker.common.js").default
);
import "vue2-timepicker/dist/VueTimepicker.css";

import { store } from "./stores/teachersStore";
// import "vue2-timepicker/dist/VueTimepicker.css";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.mixin({
//     methods: {
//         route: route
//     }
// });

Vue.use(VCalendar, {
    componentPrefix: "vc" // Use <vc-calendar /> instead of <v-calendar />
    // ...other defaults
});

// import Example from "./Components/Example.vue";
const teacher = new Vue({
    el: "#teacher",
    router,
    store,
    route //ziggy
});
