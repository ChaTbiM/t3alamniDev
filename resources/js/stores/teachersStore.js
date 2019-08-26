import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);


export const store = new Vuex.Store ({
    state:{
        test:'this is test state',
        addSessionsOpen:false,
        AddSimpleSessionOpen:false,
        AddFixedSessionOpen:false,
        addGroupOpen:false,
        fixed:'',
        simple:'',
        modules:'',
        data:'',
        
    },
    mutations:{
        changeState(state,target){
            state[target] = !state[target];
        },

        initFixed(state,data){
            state.fixed = JSON.parse(data);
        },

        
        initSimple(state,data){
            state.simple = JSON.parse(data);
        },
        
        initModules(state,data){
            state.modules = JSON.parse(data);
        },

        



    },
    getters:{
        test: state => state.test,
        addSessionsOpen : state=> state.addSessionsOpen,
        AddSimpleSessionOpen : state=> state.AddSimpleSessionOpen,
        AddFixedSessionOpen : state=> state.AddFixedSessionOpen,
        addGroupOpen : state=> state.addGroupOpen,
        fixedSessions: state => state.fixed,
        simpleSessions: state => state.simple,
        modules: state => state.modules,



    },

    

})