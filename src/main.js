import Vue from 'vue'
import 'babel-polyfill'
import VueRouter from 'vue-router'
import overview from './views/overview'
import single from './views/single'
import about from './views/about'
import pdf from './views/pdf'
import App from './App'
import store from './store'
import {parse, format} from 'date-fns'

Vue.use(VueRouter)

Vue.filter('dashed', function(value) {
  if (value) {
    return format(parse(value), 'DD.MM.YYYY')
  }
})

Vue.filter('monthYear', (value) => {
  if (value) {
    return format(parse(value), 'MMMM YYYY')
  }
})

Vue.filter('dayMonthYear', (value) => {
  if (value) {
    return format(parse(value), 'DD MMMM YYYY')
  }
})

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'overview',
      component: overview
    },
    {
      path: '/single/:slug',
      name: 'singleProject',
      component: single
    },
    {
      path: '/about',
      name: 'about',
      component: about
    },
    {
      path: '/bibliography',
      name: 'pdf',
      component: pdf
    }
  ]
})

// ga(router, 'UA-XXXXX')

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store,
  router,
  render: h => h(App)
})
