import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import files from './files'
import usage from './usage'
import snack from './snack'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth,
        files,
        usage,
        snack,
    }
})
