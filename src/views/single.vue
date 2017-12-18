<template>
  <div class="single">

    <div class="single__media">
      <img class='single__media__image' :class='{active : collapse}' :src='main.single.data.preview_image.url' @click='collapse = !collapse'/>
    </div>

    <div class="single__desc">
      <div class="single__desc--l">
        <p class="single__desc__title" v-html="main.single.data.title[0].text"></p>
        <span>Year:</span>
        <p class="single__desc__year" v-html="main.single.data.year[0].text"></p>
        <span>Materials:</span>
        <ul class="single__desc--l__material" v-if='main.single.data.materials.length > 0'>
          <li class="single__desc--l__material__item" v-for="material in main.single.data.materials" v-html="material.text"></li>
        </ul><br/>

        <div class="single__desc--l__events" v-if='main.single.data.events.length > 0'>
          <p>Events</p>

          <events :all='true'/>

        </div>
      </div>

      <div class="single__desc--r" v-if='main.single.data.description.length > 0'>
        <p class="single__desc--r__text" v-html='renderHTML'></p>
      </div>
    </div>

    <div v-if='main.single.data.vimeo_id != undefined' class="single__video">
      <div class='single__video__container'>
        <iframe :src="'https://player.vimeo.com/video/' + main.single.data.vimeo_id + '?title=0&byline=0&portrait=0'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
      </div>
    </div>

    <imageSection v-if='main.single.data.images.length > 0' :images='main.single.data.images'/>
    </div>

  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import PrismicDOM from 'prismic-dom'
import imageSection from '../components/image-section'
import events from '../components/events'

export default {
  name: 'single',
  props: ['slug'],
  components: {
    imageSection,
    events
  },
  data() {
    return {
      msg: 'Single Project View',
      collapse: false,
      content: {
        title: {
          rendered: ''
        }
      }
    }
  },
  computed: {
    ...mapState(['main', 'variables']),
    renderHTML() {
      return PrismicDOM.RichText.asHtml(this.main.single.data.description, doc => doc)
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
    ...mapActions(['SET_SINGLE']),
    setSingleActionWrapper() {
      this.SET_SINGLE(this.main.projects.find(e => e.slugs[0] === this.$route.params.slug))
    }
  },
  mounted() {
    this.setSingleActionWrapper()
    this.$emit('hideTitle')
  },
  watch: {
    'main.projects'() {
      this.setSingleActionWrapper()
    }
  }
}
</script>

<style scoped lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.single {
  background: $black;
  color: $theme-r;
  font-size: $font-size-s;
  line-height: $line-height-s;
  padding: $line-height * 3 $margin-sides;
  width: 100%;
  min-height: 100%;

  @include hide-scroll;

  @include screen-size('small') {
    padding: $line-height-s * 3 $line-height-s;
  }

  &__desc {
    width: 100%;
    padding-top: $line-height;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-bottom: $line-height * 2;

    @include screen-size('small') {
      margin-bottom: $line-height-s * 2;
    }

    &--l {
      flex-basis: 33%;
      flex-grow: 1;
      font-size: $font-size-xs;
      line-height: $line-height-xs;
      color: $white;

      @include screen-size('small') {
        flex-basis: 100%;
      }

      &__material {
        &__item {
          display: inline-block;

          &::after {
            content: ', \00a0';
          }

          &:last-of-type {
            &::after {
              content: '. \00a0';
            }
          }
        }
      }

      &__events {
        color: $theme-r;
        margin-left: -10px;
        padding-left: 10px;
        padding-top: 10px;
        padding-bottom: 10px;

        &__upcoming {
          padding-bottom: $line-height;

          &__item {
            &:first-child {
              &::before {
                content: 'Upcoming:';
                display: block;
              }
            }
          }
        }

        &__past {
          &__item {
            &:first-child {
              &::before {
                content: 'Past:';
                display: block;
              }
            }
          }
        }
      }
    }

    &--r {
      flex-basis: 67%;
      flex-grow: 2;
      padding-left: 10px;

      &__text {
        padding-left: 20px;
        max-width: 80ch;

        a {
          color: red !important;
        }

        p {
          &::after {
            content: 'a';
          }
        }

        @include screen-size('small') {
          padding-left: 0;
        }
      }
    }
  }

  &__more {
    width: 100%;
    text-align: center;
    height: $line-height * 2;

    &__text {
      color: $white;
    }
  }

  &__video {
    width: 800px;
    height: auto;
    margin: 0 auto;
    padding-top: $line-height;
    padding-bottom: $line-height;
    max-width: 100%;

    @include screen-size('small') {
      width: 400px;
    }

    &__container {
      position: relative;
      padding-bottom: 56.25%;
      margin: 0 auto;

      iframe,
      object,
      embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
      }
    }
  }

  &__media {
    width: 100%;

    &__image {
      width: 100%;
      object-fit: cover;
      object-position: 50% 50%;
      height: auto;
      max-height: 85vh;

      &.active {
        max-height: 70vh;
      }

      transition: max-height 0.03s linear;
    }
  }
}
</style>
