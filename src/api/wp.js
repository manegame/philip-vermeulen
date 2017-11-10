import Vue from 'vue'
import VueResource from 'vue-resource'

const API_ROOT = 'http://cms.philipvermeulen.com/wp-json/acf/v3/posts'

Vue.use(VueResource)

Vue.http.options.crossOrigin = true
console.log(Vue.http.options)

export default {
  getPosts() {
    return new Promise((resolve, reject) => {
      Vue.http.get(API_ROOT).then(
      // Vue.http.get(API_ROOT + 'posts/').then(
        response => {
          resolve(response.body)
        },
        response => {
          reject()
        }
      )
    })
  }
}
