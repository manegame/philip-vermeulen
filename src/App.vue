<template>
  <div id="app">
    <!-- {{main}} -->
    <headbar></headbar>
    <router-view></router-view>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import overview from './views/overview'
import headbar from './components/headbar'

export default {
  name: 'app',
  components: {
    overview, headbar
  },
  computed: {
    ...mapState([
      'main',
      'variables'
    ])
  },
  head: {
    title () {
      return {
        inner: this.title
      }
    }
  },
  methods: {
    ...mapActions(['GET_POSTS'])
  },
  mounted () {
    this.GET_POSTS()
    // this.$router.beforeEach((to, from, next) => {
    //   if (from.name === 'xxx') {}
    //   next()
    // })
  },
  watch: {
    '$route' (to, from) {}
  }
}
</script>

<style lang='scss'>
@import "./style/helpers/_mixins.scss";
@import "./style/helpers/_responsive.scss";
@import "./style/helpers/_reset.css";
@import "./style/_variables.scss";
@import "./style/_typography.scss";
@import "./assets/fonts/f_grotesk_demi.css";

#app {
  font-family: $sans-serif-stack;
  font-size: $font-size;
  line-height: $line-height;
  color: $black;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  width: 100vw;
  height: 100vh;
  z-index: -1;
  transition: background 1s ease-out;
  -webkit-transition: background 1s ease-out;
  -moz-transition: background 1s ease-out;
}

</style>
