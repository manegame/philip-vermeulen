import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  showDates: true,
  project: {
    title: 'Philip Vermeulen',
    slug: ''
  }
}

const mutations = {
  [mutationTypes.SHOW_DATES](state, bool) {
    state.showDates = !state.showDates
  },
  [mutationTypes.SET_BACKGROUND](state, color) {
    state.background = color
  },
  [mutationTypes.SET_PROJECT](state, payload) {
    state.project.slug = payload.slug
    state.project.title = payload.title
  }
}

const actions = {
  [actionTypes.SHOW_DATES]({commit, state}, bool) {
    commit(mutationTypes.SHOW_DATES, bool)
  },
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
