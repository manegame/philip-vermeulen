import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  background: '',
  main: '#fff',
  single: '#000',
  theme: '#f00',
  project: {
    title: 'Welcome',
    slug: ''
  },
  exhibitions_list: ['test', 'test2']
}

const mutations = {
  [mutationTypes.SET_BACKGROUND](state, color) {
    state.background = color
  },
  [mutationTypes.SET_PROJECT](state, payload) {
    state.project.slug = payload.slug
    state.project.title = payload.title
  }
}

const actions = {
  [actionTypes.SET_BACKGROUND]({commit, state}, color) {
    commit(mutationTypes.SET_BACKGROUND, color)
  },
  [actionTypes.SET_PROJECT]({commit, state}, {title, slug}) {
    commit(mutationTypes.SET_PROJECT, {
      title: title,
      slug: slug
    })
  }
}

export default {
  state,
  actions,
  mutations
}
