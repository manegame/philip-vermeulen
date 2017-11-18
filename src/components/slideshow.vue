<template>
  <div class="slideshow" @click='$emit("close")'>
    <img class="slideshow__image" :src='images[index].image.url'/>
  </div>
</template>

<script>
export default {
  name: 'slideshow',
  data () {
    return {
      index: this.count
    }
  },
  props: {
    images: {
      type: Array,
      required: true
    },
    count: {
      type: Number,
      required: true
    }
  }
}
</script>

<style lang="scss">
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.slideshow {
  position: fixed;
  width: 100vw;
  height: 100vh;
  top: 0;
  left: 0;
  background: $theme;
  z-index: 100;
  color: $white;
  display: flex;
  justify-content: space-around;
  align-items: center;
  cursor: pointer;

  &__image {
    object-fit: contain;
    width: 90%;
    height: auto;
    max-height: 90%;
  }
}
</style>
