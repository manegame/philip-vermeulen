<template>
  <div class="overview" :style='{ backgroundColor: variables.background }' >
    <events></events>
    <div class="overview__project" v-for="(project, index) in main.projects" @mouseover='SET_PROJECT({ slug: project.slugs[0], title: project.data.title[0].text })'>
      <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-if="isEven((index + 1))">
        <img class="overview__project__image" :src="project.data.preview_image.url"/>
        <router-link class="overview__project__link" :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
      </router-link>
      <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-else>
        <img class="overview__project__image" :src="project.data.preview_image.url"/>
        <router-link class="overview__project__link" :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
      </router-link>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import headbar from '../components/headbar'
import events from '../components/events'
import TWEEN from 'tween.js'
let Color = require('color-js')

export default {
  name: 'overview',
  components: {
    headbar,
    events
  },
  data() {
    return {
      msg: 'overview',
      newColor: 'rgb(0,0,255)',
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
    ...mapActions(['GET_POSTS', 'SET_BACKGROUND', 'SET_PROJECT']),
    debug () {
      console.log('uhhh')
    },
    isEven: (n) => {
      return n % 2 === 0
    },
    updateColor: () => {
      this.color = new Color(this.newColor).toRGB()
      console.log(this.color)
      this.newColor = ''
    }
  },
  mounted() {
    this.GET_POSTS()
    this.SET_BACKGROUND(this.variables.main)
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

  @include screen-size('small') {
    padding: $margin-top $line-height-s;
  }

  &__project {
    height: $line-height * 9;
    width: auto;
    margin-top: $line-height;
    clear: none;
    z-index: 1;

    @include screen-size('small') {
      height: $line-height-s * 9;
      margin-top: $line-height-s;
    }

    &:nth-child(even) {
      float: right;
      clear: right;
      margin-top: $line-height * 3;
      text-align: right;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &:nth-child(odd) {
      float: left;
      clear: left;
      margin-top: $line-height * 3;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &:nth-child(2) {
      margin-top: $line-height * 6;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &__image {
      height: 100%;
      width: auto;
    }

    &__link {
      font-size: $font-size-s;
      line-height: $line-height-s;
      width: auto;
      display: none;

      @include screen-size('small') {
        display: block;
      }
    }
  }
}
</style>
