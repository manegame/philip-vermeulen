import api from '../../api/prismic'
import convert from 'color-convert'
import * as actionTypes from '../actionTypes'
import * as mutationTypes from '../mutationTypes'

const state = {
  color: {
    hue: 0,
    sat: 18,
    lit: 80
  },
  vimeoColor: '',
  projects: [],
  single: {},
  about: [],
  shop: [],
  events: [],
  library: {}
}

const actions = {
  async [actionTypes.GET_LIBRARY]({commit, state}) {
    commit(mutationTypes.SET_LIBRARY, await api.getLibrary())
  },
  [actionTypes.SET_COLOR]({commit, state}) {
    commit(mutationTypes.SET_COLOR)
  },
  [actionTypes.GET_VIMEO_COLOR]({commit, state}) {
    commit(mutationTypes.SET_VIMEO_COLOR)
  },
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
  [mutationTypes.SET_COLOR](state) {
    if (state.color.hue < 360) {
      state.color.hue++
    } else {
      state.color.hue = 0
    }
  },
  [mutationTypes.SET_VIMEO_COLOR](state) {
    state.vimeoColor = convert.hsl.hex(state.color.hue, state.color.sat, state.color.lit)
  },
  [mutationTypes.SET_POSTS](state, data) {
    state.projects = data.filter(e => e.type === 'project')
    state.about = data.filter(e => e.type === 'about')
    state.shop = data.filter(e => e.type === 'product')
  },
  [mutationTypes.SET_LIBRARY](state, data) {
    state.library = data
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

const getters = {
  dynamicColor: (state) => {
    return 'hsl(' + state.color.hue + ', ' + state.color.sat + '%, ' + state.color.lit + '%)'
  }
}

export default {
  state,
  getters,
  actions,
  mutations
}
