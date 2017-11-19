import api from '../../api/prismic'
import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  projects: [],
  single: {},
  about: [],
  shop: [],
  events: []
}

const actions = {
  async [actionTypes.GET_POSTS]({commit, state}) {
    commit(mutationTypes.SET_POSTS, await api.getPosts())
  },
  async [actionTypes.GET_EVENTS]({commit, state}) {
    commit(mutationTypes.SET_EVENTS, await api.getEvents())
  },
  [actionTypes.SET_SINGLE]({commit, state}, post) {
    commit(mutationTypes.SET_SINGLE, post)
  }
}

const mutations = {
  [mutationTypes.SET_POSTS](state, data) {
    state.projects = data.filter(e => e.type === 'project')
    state.about = data.filter(e => e.type === 'about')
    state.shop = data.filter(e => e.type === 'product')
  },
  [mutationTypes.SET_EVENTS](state, data) {
    state.events = data.map((e) => {
      return e.data.events.map((l) => {
        return l
      })
    })
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
