<template>
  <div class="about">
    <div class="about__text">

      <p class="about__text__shop" @click='showShop = true'>Shop</p>
      <shop v-if='showShop' @close='showShop = false'/>

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

      <p>
        Upcoming Exhibitions:
      </p>


      <span>Past Exhibitions: </span>
      <ul class="about__text__list" v-for='item in main.about[0].data.past_exhibitions'>
        <li v-html='item.year[0].text'></li>
        <li v-for='entry in item.list' v-html='entry.text'></li>
      </ul>

      <span>Residencies: </span>
      <ul class="about__text__list">
        <li v-for='item in main.about[0].data.residencies' v-html='item.text'></li>
      </ul>

      <span>Internships: </span>
      <ul class="about__text__list">
        <li v-for='item in main.about[0].data.internships' v-html='item.text'></li>
      </ul>

      <span>Education: </span>
      <ul class="about__text__list">
        <li v-for='item in main.about[0].data.education' v-html='item.text'></li>
      </ul>

      <span>Other: </span>
      <ul class="about__text__list">
        <li v-for='item in main.about[0].data.other' v-html='item.text'></li>
      </ul>

    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import PrismicDOM from 'prismic-dom'
import shop from '../components/shop'

export default {
  name: 'about',
  components: {
    shop
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
  position: absolute;
  overflow-y: scroll;
  z-index: 0;
  padding: $margin-top * 9 $margin-sides;
  font-size: 20px;
  line-height: 24px;
  background: $theme;
  color: $black;

  &__text {
    &__intro,
    &__contact,
    &__shop {
      padding-bottom: $line-height;
    }

    &__shop {
      cursor: pointer;
      color: $white;
    }

    &__list {
      margin-bottom: $line-height;
    }

    &__contact {
      display: block;
    }
  }

  @include screen-size('small') {
    padding: $line-height-s * 3 $line-height-s;
  }
}

</style>
