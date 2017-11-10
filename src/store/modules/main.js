import api from '../../api/prismic'
import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  projects: [],
  single: {},
  about: []
}

const actions = {
  async [actionTypes.GET_POSTS]({commit, state}) {
    commit(mutationTypes.SET_POSTS, await api.getPosts())
  },
  [actionTypes.SET_SINGLE]({commit, state}, post) {
    commit(mutationTypes.SET_SINGLE, post)
  }
}

const mutations = {
  [mutationTypes.SET_POSTS](state, data) {
    state.projects = data.filter(e => e.type === 'project')
    state.about = data.filter(e => e.type === 'about')
  },
  [mutationTypes.SET_SINGLE](state, post) {
    state.single = post
  }
}

export default {
  state,
  actions,
  mutations
}
