<template>
  <div class="single">

    <!-- ORDER -->

    <!-- LEFT -->

      <!-- Title -->
        <!-- Year -->
        <!-- Materials -->
        <!-- (upcoming) -->
        <!-- Events + Dates -->
        <!-- (past) -->
        <!-- Events + Dates  -->

    <!-- RIGHT -->

      <!-- Description -->

    <!-- BOTTOM -->
      <!-- Images -->


    <div class="single__desc">
      <div class="single__desc--l">
        <p class="single__desc__title" v-html="main.single.data.title[0].text"></p><br/>
        <p class="single__desc__year" v-html="main.single.data.year[0].text"></p><br/>

        <p>Materials:</p>

        <ul class="single__desc--l__material">
          <li class="single__desc--l__material__item" v-for="material in main.single.data.materials" v-html="material.text"></li>
        </ul><br/>

        <div class="single__desc--l__events" v-if='main.single.data.events.length > 0'>
          <p>Events</p><br/>

          <ul class="single__desc--l__events__upcoming">
            <li class="single__desc--l__events__upcoming__item" v-for='a in main.single.data.events'>
              <span v-if='!isPast(a.from)'>
                {{a.event[0].text}}:
                {{a.to | dayMonthYear}}
              </span>
            </li>
          </ul>

          <ul class="single__desc--l__events__past">
            <li class="single__desc--l__events__past__item" v-for='a in main.single.data.events'>
              <span v-if='isPast(a.from)'>
                {{a.event[0].text}}:
                {{a.to | monthYear}}
              </span>
            </li>
          </ul>
        </div>
      </div>

      <div class="single__desc--r">
        <p class="single__desc--r__text" v-html='renderHTML'></p>
      </div>
    </div>

      <div class="single__media">
        <img class="single__media__img" :src='main.single.data.images[0].image.url'/>
      </div>
    </div>

    <!-- <div v-if='main.single.data.vimeo_id'>
      <div class='embed-responsive'>
        <iframe :src="'https://player.vimeo.com/video/' + main.single.data.vimeo_id + '?title=0&byline=0&portrait=0'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
      </div>
    </div> -->

  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import PrismicDOM from 'prismic-dom'
import moment from 'moment'

export default {
  name: 'single',
  props: ['slug'],
  data() {
    return {
      msg: 'Single Project View',
      content: {
        title: {
          rendered: ''
        }
      }
    }
  },
  computed: {
    ...mapState(['main']),
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
    },
    isPast(d) {
      let now = moment()
      if (now.diff(d, 'days') > 0) {
        return true
      } else {
        return false
      }
    }
  },
  filters: {
    pastDate(value) {
      let now = moment()
      if (now.diff(value, 'days') > 0) {
        return true
      }
    },
    upcomingDate(value) {
      let now = moment()
      if (now.diff(value, 'days') === 0 || now.diff(value, 'days') < 0) {
        return true
      }
    }
  },
  mounted() {
    this.setSingleActionWrapper()
  },
  watch: {
    'main.projects'() {
      this.setSingleActionWrapper()
    },
    '$route' (to, from) {
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
  color: $theme;
  font-size: 20px;
  line-height: 28px;
  padding: $margin-top $margin-sides;
  z-index: 0;
  width: 100%;
  min-height: 100%;

  &__desc {
    padding-top: $line-height * 4;
    width: 100%;
    display: flex;
    justify-content: space-between;

    &--l {
      flex-basis: 33%;
      flex-grow: 1;

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
    }
  }

  &__media {
    width: 100%;

    &__img {
      width: 100%;
    }
  }
}
</style>
