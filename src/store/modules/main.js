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
  [actionTypes.SET_SINGLE]({commit, state}, post) {
    commit(mutationTypes.SET_SINGLE, post)
  },
  async [actionTypes.SET_EVENTS]({commit, state}) {
    commit(mutationTypes.SORT_EVENTS, await api.getProjects())
  }
}

const mutations = {
  [mutationTypes.SET_POSTS](state, data) {
    state.projects = data.filter(e => e.type === 'project')
    state.about = data.filter(e => e.type === 'about')
    state.shop = data.filter(e => e.type === 'product')
  },
  [mutationTypes.SET_SINGLE](state, post) {
    state.single = post
  },
  [mutationTypes.SORT_EVENTS](state, data) {
    data.map((project) => {
      if (project.data.events) {
        state.events.push({
          project: project.data.title[0].text,
          events: project.data.events,
          slug: project.slugs[0]
        })
      }
    })
  }
}

export default {
  state,
  actions,
  mutations
}
