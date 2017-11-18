<template>
  <div class="image_section">
    <div class="image_section__item" v-for='(item, index) in images'>
      <img class="image_section__item__image" :src='item.image.url' @click='slideshowActive = true; count = index'/>
    </div>
    <slideshow v-if='slideshowActive' @close='slideshowActive = false' :images='images' :count='count' />
  </div>
</template>

<script>
import slideshow from './slideshow'

export default {
  name: 'image-section',
  components: {
    slideshow
  },
  data () {
    return {
      slideshowActive: false,
      count: 0
    }
  },
  props: {
    images: {
      type: Array,
      required: true
    }
  }
}
</script>

<style lang="scss">
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.image_section {
  clear: none;
  width: 100%;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;

  &__item {
    position: relative;
    float: left;
    width: auto;
    max-width: 100%;
    height: $line-height * 8;
    padding-bottom: $line-height;
    padding-right: $line-height;
    object-fit: cover;

    &__image {
      cursor: pointer;
      height: 100%;
    }
  }
}
</style>
