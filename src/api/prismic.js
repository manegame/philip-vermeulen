import Prismic from 'prismic-javascript'

const apiEndpoint = 'https://philip-vermeulen.prismic.io/api/v2'

export default {
  getLibrary() {
    return new Promise((resolve, reject) => {
      Prismic.getApi(apiEndpoint)
      .then(api => {
        return api.getSingle('library')
        .then((document) => {
          resolve(document)
        })
      })
    })
  },
  getPosts() {
    return new Promise((resolve, reject) => {
      Prismic.getApi(apiEndpoint)
        .then(api => {
          return api.query('')
        })
        .then(
          response => {
            resolve(response.results)
          },
          err => {
            console.log('Something went wrong: ', err)
            reject()
          }
        )
    })
  },
  getProjects() {
    return new Promise((resolve, reject) => {
      Prismic.getApi(apiEndpoint)
        .then(api => {
          return api.query(
            Prismic.Predicates.at('document.type', 'project')
          )
        })
        .then(
          response => {
            resolve(response.results)
          },
          err => {
            console.log('Something went wrong: ', err)
            reject()
          }
        )
    })
  }

}
