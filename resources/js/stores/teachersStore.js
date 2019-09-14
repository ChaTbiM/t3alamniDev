import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
    console.error(
        "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
    );
}

export const store = new Vuex.Store({
    state: {
        test: "this is test state",
        //adding Sessions
        addSessionsOpen: false,
        AddSimpleSessionOpen: false,
        AddFixedSessionOpen: false,
        addGroupOpen: false,

        teacherId: "",

        choosedGroup: "",
        attrs: [
            {
                key: "today",
                dates: null,
                highlight: "red"
            }
        ],
        date: new Date(),
        duration: "",
        time: {
            HH: "",
            mm: ""
        },
        fixedSessionID: "",
        simpleSessionID: "",

        //sessions data
        fixed: null,
        simple: [],
        modules: null,

        // Students
        groupStudents: null,
        groupID: null
    },
    mutations: {
        //showing sessions
        changeGroupStudents(state, data) {
            state.groupStudents = data;
        },
        changeGroupID(state, data) {
            state.groupID = data;
        },
        changeState(state, target) {
            state[target] = !state[target];
        },

        initFixed(state, data) {
            state.fixed = JSON.parse(data);
        },

        initSimple(state, data) {
            state.simple = JSON.parse(data);
        },

        initModules(state, data) {
            state.modules = JSON.parse(data);
        },

        initTeacherID(state, id) {
            state.teacherId = JSON.parse(id);
        },
        //adding sessions
        setDates(state, data) {
            state.attrs[0].dates = new Date(data);
        },

        setAttrs(state, data) {
            state.attrs = data;
        },
        setDate(state, date) {
            state.date = date;
        },
        chooseGroup(state, data) {
            state.choosedGroup = data;
        },
        setTime(state, data) {
            state.time = data;
        },

        setHour(state, hour) {
            state.time.HH = hour;
        },

        setDuration(state, data) {
            state.duration = data;
        },

        setFixedSessionID(state, id) {
            state.fixedSessionID = id;
        },

        setSimpleSessionID(state, id) {
            state.simpleSessionID = id;
        }
    },
    actions: {
        initFixed: async context => {
            let fixedSessions = await axios.get(route("getFixedSessions"));
            if (fixedSessions.status === 200) {
                context.commit("initFixed", fixedSessions.data.fixedSessions);
                context.commit("initModules", fixedSessions.data.modules);
                context.commit("initTeacherID", fixedSessions.data.id);

                let data = JSON.parse(fixedSessions.data.fixedSessions);
                if (data.length) {
                    let lastFixedSessionID = data[data.length - 1].id;
                    context.commit("setFixedSessionID", lastFixedSessionID);
                } else {
                    context.commit("setFixedSessionID", 0);
                }
            }
            // return fixedSessions;
        },
        initSimple: async context => {
            let simpleSessions = await axios.get(route("getSimpleSessions"));
            if (simpleSessions.status === 200) {
                context.commit("initSimple", simpleSessions.data);
                let data = JSON.parse(simpleSessions.data);
                if (data.length) {
                    let lastSimpleSessionID = data[data.length - 1].id;
                    context.commit("setSimpleSessionID", lastSimpleSessionID);
                } else {
                    context.commit("setSimpleSessionID", 0);
                }
            }
            // return fixedSessions;
        },
        SET_GROUP_STUDENTS: async context => {
            let data = await axios.get(route("getGroupsStudents"));

            if (data.status === 200) {
                context.commit("changeGroupStudents", data.data);
            }
        }
    },
    getters: {
        test: state => state.test,
        initState: state => state.data,
        teacherId: state => state.teacherId,

        //adding sessions
        addSessionsOpen: state => state.addSessionsOpen,
        AddSimpleSessionOpen: state => state.AddSimpleSessionOpen,
        AddFixedSessionOpen: state => state.AddFixedSessionOpen,
        addGroupOpen: state => state.addGroupOpen,

        choosedGroup: state => state.choosedGroup,

        attrs: state => state.attrs,
        dates: state => state.attrs[0].dates,

        time: state => state.time,
        date: state => state.date, // need state init and mutation
        duration: state => state.duration,
        fixedSessionID: state => state.fixedSessionID,
        simpleSessionID: state => state.simpleSessionID,

        //sessions data
        fixedSessions: state => state.fixed,
        simpleSessions: state => state.simple,
        modules: state => state.modules,
        //students
        groupStudents: state => state.groupStudents,
        groupID: state => state.groupID
    }
});
