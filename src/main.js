import Vue from 'vue'
import 'babel-polyfill'
import VueRouter from 'vue-router'
import overview from './views/overview'
import single from './views/single'
import about from './views/about'
import App from './App'
import store from './store'
import moment from 'moment'

Vue.use(VueRouter)

Vue.filter('monthYear', (value) => {
  return moment(String(value)).format('MMMM YYYY')
})

Vue.filter('dayMonthYear', (value) => {
  return moment(String(value)).format('DD MMMM YYYY')
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
