<template>
  <div class="overview" :style='{ backgroundColor: tweenedCSSColor }' @click='updateColor'>
    <div class="overview__project" v-for="(project, index) in main.projects">
      <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-if="isEven((index + 1))">
        <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
        <img class="overview__project__image" :src="project.data.preview_image.url"/>
      </router-link>
      <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-else>
        <img class="overview__project__image" :src="project.data.preview_image.url"/>
        <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
      </router-link>
    </div>
    <!-- <input v-model="colorQuery" v-on:keyup.enter="updateColor" placeholder="Enter a color" style='z-index:1000'>
      <button v-on:click="updateColor">Update</button>
      <p>Preview:</p>
      <span v-bind:style="{ backgroundColor: tweenedCSSColor }"></span>
      <p>{{ tweenedCSSColor }}</p> -->
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import headbar from '../components/headbar'
import TWEEN from 'tween.js'
let Color = require('color-js')

export default {
  name: 'overview',
  components: {
    headbar
  },
  data() {
    return {
      msg: 'overview',
      newColor: 'rgb(0,0,255)',
      // colorQuery: '',
      color: {
        red: 0,
        green: 0,
        blue: 0,
        alpha: 1
      },
      tweenedColor: {}
    }
  },
  created: function () {
    this.tweenedColor = Object.assign({}, this.color)
  },
  computed: {
    ...mapState(['main', 'variables']),
    tweenedCSSColor: function () {
      return new Color({
        red: this.tweenedColor.red,
        green: this.tweenedColor.green,
        blue: this.tweenedColor.blue,
        alpha: this.tweenedColor.alpha
      }).toCSS()
    }
  },
  head: {
    title() {
      return {
        inner: this.title
      }
    }
  },
  methods: {
    ...mapActions(['GET_POSTS', 'SET_BACKGROUND']),
    isEven: (n) => {
      return n % 2 === 0
    },
    updateColor: function () {
      this.color = new Color(this.newColor).toRGB()
      console.log(this.color)
      this.newColor = ''
    }
  },
  mounted() {
    this.GET_POSTS()
  },
  watch: {
    $route(to, from) {},
    color: function () {
      function animate () {
        if (TWEEN.update()) {
          window.requestAnimationFrame(animate)
        }
      }
      new TWEEN.Tween(this.tweenedColor)
        .to(this.color, 750)
        .start()
      animate()
    }
  }
}
</script>

<style scoped lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.overview {
  padding: $margin-top $margin-sides;
  width: 100%;
  height: 100%;
  overflow-y: scroll;
  z-index: 0;

  &__project {
    height: $line-height * 9;
    width: auto;
    margin-top: $line-height;
    clear: none;
    z-index: 1;

    &:nth-child(even) {
      float: right;
      clear: right;
      margin-top: $line-height;
    }

    &:nth-child(odd) {
      float: left;
      clear: left;
      margin-top: $line-height;
    }

    &:nth-child(2) {
      margin-top: $line-height;
    }

    &__image {
      height: 100%;
      width: auto;
    }
  }
}
</style>
