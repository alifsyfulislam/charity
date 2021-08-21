import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({

    state: {
        causeSlug : "Zakat",
    },

    getters:{
        getCauseSlug : state => {
            return state.causeSlug
        }
    },
    mutations: {

    },
    actions:{

    }
})
