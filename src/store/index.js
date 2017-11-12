import Vue from 'vue'
import Vuex from 'vuex'
import main from './modules/main'
import variables from './modules/variables'

Vue.use(Vuex)

const DEBUG = process.env.NODE_ENV === 'development'

export default new Vuex.Store({
  modules: {
    main,
    variables
  },
  strict: DEBUG
})
