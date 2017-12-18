<template>
  <div class="shop">
    <div class="shop__item" v-for='item in main.shop'>
      <img class="shop__item__image" :src='item.data.product_image.url'/>
      <div class="shop__item__meta">
        <span class="shop__item__meta__title" v-html='item.data.product_name[0].text'/>
        <span class="shop__item__meta__price" v-html='item.data.price[0].text'/>
        <form class="shop__item__meta__paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
          <input type="hidden" name="cmd" value="_s-xclick">
          <input type="hidden" name="hosted_button_id" :value="item.data.paypal[0].text">
          <input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynow_SM.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online!">
          <img class="shop__item__meta__paypal__button" alt="" border="0" src="https://www.paypalobjects.com/nl_NL/i/scr/pixel.gif" width="1" height="1">
        </form>
        <span class="shop__item__meta__description" v-html='item.data.product_description[0].text'/>
      </div>
    </div>
    <div class="shop__close">
      <span @click.self='$emit("close")'>×</span>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import slideshow from './slideshow'

export default {
  name: 'shop',
  components: {
    slideshow
  },
  computed: {
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_POSTS'])
  },
  mounted() {
    this.GET_POSTS()
  }
}
</script>

<style lang="scss">
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.shop {
  font-size: $font-size;
  line-height: $line-height;
  position: fixed;
  width: 100vw;
  height: 100vh;
  overflow-y: scroll;
  top: 0;
  left: 0;
  background: $black;
  z-index: 1000;
  color: $white;
  padding: $line-height * 2 $margin-sides;
  cursor: pointer;

  @include hide-scroll;

  &__close {
    text-align: right;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    padding-right: $margin-sides;
    padding-top: $margin-top;
    height: auto;
  }

  &__item {
    height: $line-height * 9;
    margin-top: $line-height;
    margin-bottom: $line-height;
    display: flex;
    align-items: flex-end;
    text-align: left;

    &:last-child {
      margin-bottom: 0;
    }

    &:nth-child(even) {
      float: right;
      clear: right;
      flex-direction: row-reverse;

      img {
        padding-right: 0;
        padding-left: $line-height;
      }

      * {
        text-align: right;
      }
    }

    &:nth-child(odd) {
      float: left;
      clear: left;
    }

    &__meta {
      color: $white;

      &__title,
      &__price {
        display: block;
      }

      &__description {
        font-size: $font-size-s;
        line-height: $line-height-s;
      }

      &__paypal {
        text-align: left;

        img {
          width: 1px;
          display: block;
        }
      }
    }

    &__image {
      object-fit: contain;
      width: auto;
      height: 100%;
      padding-right: $line-height;
      padding-left: 0;
    }
  }
}
</style>
