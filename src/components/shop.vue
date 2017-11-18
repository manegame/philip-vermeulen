<template>
  <div class="shop" @click='$emit("close")'>
    <div class="shop__item">
      <img class="shop__item__image" :src='main.shop[0].data.product_image.url'/>
      <p class="shop__item__meta">
        <p v-html='main.shop[0].data.product_name[0].text'/>
        <p v-html='main.shop[0].data.price[0].text'/>
        <p>BUY</p>
      </p>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'

export default {
  name: 'shop',
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
  position: fixed;
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  background: $black;
  z-index: 100;
  color: $white;
  display: flex;
  justify-content: space-around;
  align-items: center;
  cursor: pointer;

  &__item {
    padding: 0 $margin-sides;

    &__image {
      object-fit: contain;
      width: 100%;
      height: auto;
      max-height: 90%;
    }
  }
}
</style>
