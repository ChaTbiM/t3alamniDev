import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

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
                dates: new Date(),
                highlight: "blue"
            }
        ],
        duration: "",
        time: {
            HH: "",
            mm: ""
        },
        fixedSessionID: "",
        simpleSessionID: "",

        //sessions data
        fixed: "",
        simple: "",
        modules: ""
    },
    mutations: {
        //showing sessions
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
        chooseGroup(state, data) {
            state.choosedGroup = data;
        },
        setDate(state, date) {
            state.attrs[0].dates = new Date(2019, 9, 7);
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

        dates: state => state.attrs[0].dates,
        time: state => state.time,
        date: state => state.date, // need state init and mutation
        duration: state => state.duration,
        fixedSessionID: state => state.fixedSessionID,
        simpleSessionID: state => state.simpleSessionID,

        //sessions data
        fixedSessions: state => state.fixed,
        simpleSessions: state => state.simple,
        modules: state => state.modules
    }
});
