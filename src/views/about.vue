<template>
  <div class="about">
    <div class="about__column">
      <p class="about__column__shop" @click='showShop = true'>Shop</p>
      <shop v-if='showShop' @close='showShop = false'/>

      <div class="about__column__text">
        <p class="about__column__text__intro">{{main.about[0].data.text[0].text}}</p>

        <span class="about__column__text__contact" v-html='renderHTML(this.main.about[0].data.contact)'></span>
      </div>
    </div>

    <div class="about__column">

      <events :close='false' />

      <p class="about__column__text__cv" @click='cv = !cv'>CV</p>

      <span v-if='cv'>
        <span class="about__column__list-header">Past Exhibitions<br/><br/></span>
        <ul class="about__column__list" v-for='item in main.about[0].data.past_exhibitions'>
          <p v-html='item.year[0].text'></p>
          <li class="about__column__list__item" v-for='entry in item.list' v-html='entry.text'></li>
        </ul>

        <span class="about__column__list-header">Residencies<br/><br/></span>
        <ul class="about__column__list">
          <li class="about__column__list__item" v-for='item in main.about[0].data.residencies' v-html='item.text'></li>
        </ul>

        <span class="about__column__list-header">Internships<br/><br/></span>
        <ul class="about__column__list">
          <li class="about__column__list__item" v-for='item in main.about[0].data.internships' v-html='item.text'></li>
        </ul>

        <span class="about__column__list-header">Education<br/><br/></span>
        <ul class="about__column__list">
          <li class="about__column__list__item" v-for='item in main.about[0].data.education' v-html='item.text'></li>
        </ul>

        <span class="about__column__list-header">Other<br/><br/></span>
        <ul class="about__column__list">
          <li class="about__column__list__item" v-for='item in main.about[0].data.other' v-html='item.text'></li>
        </ul>
      </span>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import PrismicDOM from 'prismic-dom'
import shop from '../components/shop'
import events from '../components/events'

export default {
  name: 'about',
  components: {
    shop,
    events
  },
  data () {
    return {
      showShop: false,
      cv: true
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
    ...mapActions(['GET_POSTS']),
    renderHTML(el) {
      return PrismicDOM.RichText.asHtml(el, doc => doc)
    }
  },
  mounted() {
    this.GET_POSTS()
  }
}
</script>

<style scoped lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.about {
  padding: $margin-top * 9 $margin-sides;
  min-height: 100%;
  overflow-y: hidden;
  font-size: $font-size-xs;
  line-height: $line-height-xs;
  background: $theme-r;
  color: $black;
  z-index: -1;

  &__column {
    @include hide-scroll;

    position: relative;
    width: 50%;
    height: 100%;
    float: left;

    &:nth-child(2) {
      padding-left: $margin-sides;
    }

    @include screen-size('small') {
      width: 100%;

      &:nth-child(2) {
        padding-left: 0;
      }
    }

    &__shop {
      position: fixed;
      font-size: $font-size;
      line-height: $line-height;
      bottom: 0;
      right: 0;
      width: 33%;
      padding-top: $line-height;
      padding-right: $margin-sides;
      padding-bottom: $line-height;
      text-align: right;
      color: $white;
      cursor: pointer;
      z-index: 99;
    }

    &__list {
      max-width: 60ch;
      margin-bottom: $line-height;

      &__item {
        padding-left: $line-height;
      }
    }

    &__text {
      &__intro {
        max-width: 80ch;
      }

      &__intro,
      &__contact {
        padding-bottom: $line-height;
      }

      &__contact {
        display: block;

        * {
          color: $white;
        }
      }
    }
  }

  @include screen-size('small') {
    padding: $line-height-s * 3 $line-height-s;
  }
}

</style>
