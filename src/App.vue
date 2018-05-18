<template>
  <div id="app">
    <headbar :showTitle='$route.name !== "pdf"'></headbar>
    <router-view></router-view>
  </div>
</template>

<script>
import {mapState, mapActions, mapGetters} from 'vuex'
import overview from './views/overview'
import headbar from './components/headbar'

export default {
  name: 'app',
  components: {
    overview,
    headbar
  },
  computed: {
    ...mapState([
      'main',
      'variables'
    ]),
    ...mapGetters(['dynamicColor'])
  },
  head: {
    title () {
      return {
        inner: this.title
      }
    }
  },
  methods: {
    ...mapActions(['GET_POSTS', 'SET_EVENTS', 'SET_COLOR']),
    hideTitle () {
      if (this.$route.name === 'overview') { this.showTitle = true }
      if (this.$route.name === 'singleProject') { this.showTitle = false }
      if (this.$route.name === 'about') { this.showTitle = false }
    }
  },
  mounted () {
    this.GET_POSTS()
    this.SET_EVENTS()
    this.hideTitle()
    window.setInterval(() => {
      this.SET_COLOR()
    }, 100)
  },
  watch: {
    '$route' (to, from) {
      this.hideTitle()
    }
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
  overflow-x: hidden;

  @include hide-scroll;

  @include screen-size('small') {
    font-size: 22px;
    line-height: 26px;
  }
}

</style>
