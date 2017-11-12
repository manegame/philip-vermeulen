import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  background: '',
  overview: '#fff',
  single: '#000',
  theme: '#c3c5d5',
  title: 'Title'
}

const actions = {
  [actionTypes.SET_BACKGROUND]({commit, state}) {
    commit(mutationTypes.SET_BACKGROUND)
  }
  // async [actionTypes.GET_POSTS]({commit, state}) {
  //   commit(mutationTypes.SET_POSTS, await api.getPosts())
  // }
}

const mutations = {
  [mutationTypes.SET_BACKGROUND](state) {
    state.title = this.msg
    // if (this.$route.name === 'overview') {
    //   state.background = state.theme
    // }
  }
  // [mutationTypes.SET_SINGLE](state, post) {
  //   state.single = post
  // }
}

export default {
  state,
  actions,
  mutations
}
