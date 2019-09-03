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

        choosedGroup: "",

        //sessions data
        fixed: "",
        simple: "",
        modules: ""
    },
    mutations: {
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

        chooseGroup(state, data) {
            state.choosedGroup = data;
        }
    },
    getters: {
        test: state => state.test,
        initState: state => state.data,
        //adding sessions
        addSessionsOpen: state => state.addSessionsOpen,
        AddSimpleSessionOpen: state => state.AddSimpleSessionOpen,
        AddFixedSessionOpen: state => state.AddFixedSessionOpen,
        addGroupOpen: state => state.addGroupOpen,
        choosedGroup: state => state.choosedGroup,
        //sessions data
        fixedSessions: state => state.fixed,
        simpleSessions: state => state.simple,
        modules: state => state.modules
    }
});
