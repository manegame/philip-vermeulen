<template>
  <div class="about">
    <p class="about__shop" @click='showShop = true'>Shop</p>
    <shop v-if='showShop' @close='showShop = false'/>

    <div class="about__text">
      <p class="about__text__intro">{{main.about[0].data.text[0].text}}</p>

      <p>
        Contact
      </p>

      <span class="about__text__contact" v-html='renderHTML(this.main.about[0].data.contact)'></span>

      <!-- ORDER -->

      <!-- UPCOMING EXHIBITIONS && SHOP -->

      <!-- About Philip -->
      <!-- Contact -->

      <!-- Past Exhibitions -->

      <!-- Residencies -->
      <!-- Internships -->
      <!-- Education -->
      <!-- Other -->

      <events :close='false' />

      <p>Past Exhibitions: </p>
      <ul class="about__text__list" v-for='item in main.about[0].data.past_exhibitions'>
        <p v-html='item.year[0].text'></p>
        <li class="about__text__list__item" v-for='entry in item.list' v-html='entry.text'></li>
      </ul>

      <p>Residencies: </p>
      <ul class="about__text__list">
        <li class="about__text__list__item" v-for='item in main.about[0].data.residencies' v-html='item.text'></li>
      </ul>

      <p>Internships: </p>
      <ul class="about__text__list">
        <li class="about__text__list__item" v-for='item in main.about[0].data.internships' v-html='item.text'></li>
      </ul>

      <p>Education: </p>
      <ul class="about__text__list">
        <li class="about__text__list__item" v-for='item in main.about[0].data.education' v-html='item.text'></li>
      </ul>

      <p>Other: </p>
      <ul class="about__text__list">
        <li class="about__text__list__item" v-for='item in main.about[0].data.other' v-html='item.text'></li>
      </ul>

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
  width: 100%;
  height: 100%;
  overflow-y: scroll;
  padding: $margin-top * 9 $margin-sides;
  font-size: 20px;
  line-height: 24px;
  background: $theme-r;
  color: $black;
  z-index: -1;

  @include hide-scroll;

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
  }

  &__text {
    &__intro {
      max-width: 80ch;
    }

    &__intro,
    &__contact {
      padding-bottom: $line-height;
    }

    &__list {
      max-width: 60ch;
      margin-bottom: $line-height;

      &__item {
        padding-left: $line-height;
      }
    }

    &__contact {
      display: block;

      * {
        color: $white;
      }
    }
  }

  @include screen-size('small') {
    padding: $line-height-s * 3 $line-height-s;
  }
}

</style>
