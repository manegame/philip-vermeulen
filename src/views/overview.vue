<template>
  <div class="overview" :style='{ backgroundColor: variables.background }'>
    <div class="overview__events">
      <events v-if='variables.showDates' :close='true' @close='this.SHOW_DATES'></events>
    </div>
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
import shop from '../components/shop'

export default {
  name: 'overview',
  components: {
    headbar,
    events,
    shop
  },
  data() {
    return {
      msg: 'overview',
      showShop: false
    }
  },
  computed: {
    ...mapState(['main', 'variables'])
  },
  head: {
    title() {
      return {
        inner: this.title
      }
    }
  },
  methods: {
    ...mapActions(['GET_POSTS', 'SHOW_DATES', 'SET_PROJECT']),
    isEven: (n) => {
      return n % 2 === 0
    }
  },
  mounted() {
    this.GET_POSTS()
    console.log(this.SHOW_DATES)
  },
  watch: {
    $route(to, from) {}
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
  z-index: 100;

  @include hide-scroll;

  @include screen-size('small') {
    padding: $margin-top $line-height-s;
  }

  &__shop {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    padding-top: $line-height;
    padding-bottom: $line-height;
    text-align: center;
  }

  &__events {
    width: 100%;
    margin: 0;
    padding-left: 0;
    padding-right: 0;
    padding-top: $line-height * 2;
  }

  &__project {
    height: $line-height * 12;
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
      clear: left;
      margin-top: $line-height * 3;
      text-align: right;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &:nth-child(odd) {
      float: left;
      clear: right;
      margin-top: $line-height * 3;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &:last-child {
      margin-bottom: $line-height * 10;

      @include screen-size('small') {
        margin-top: $line-height-s * 3;
      }
    }

    &:nth-child(2) {
      margin-top: $line-height * 3;

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
      color: $black;
      width: auto;
      display: none;

      &:visited,
      &:active,
      &:hover {
        color: $black;
      }

      @include screen-size('small') {
        display: block;
      }
    }
  }
}
</style>
