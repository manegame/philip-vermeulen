<template>
  <div class="slideshow" @click.self='$emit("close")'>
    <img class="slideshow__image"
        :src='images[index].image.url'
        @click='$emit("close")'/>
    <div class="slideshow__nav"
         v-if="max > 1">
      <a class='slideshow__nav__button'
         @click='previous'><</a>
      <a class='slideshow__nav__button'
         @click='next'>></a>
    </div>
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
  },
  methods: {
    navigation(event) {
      if (event.keyCode === 37) this.previous()
      if (event.keyCode === 39) this.next()
      if (event.keyCode === 27) this.$emit('close')
    },
    previous() {
      if (this.index > 0) {
        this.index--
        if (this.images[this.index].type === 'none') {
          this.previous()
        }
      } else {
        this.index = this.max - 1
      }
    },
    next() {
      if (this.index < this.max - 1) {
        this.index++
        if (this.images[this.index].type === 'none') {
          this.next()
        }
      } else {
        this.index = 0
      }
    }
  },
  computed: {
    max() {
      return this.images.length
    },
    countMax() {
      let skip = this.images.filter(image => image.type === 'none')
      return this.max - skip.length
    }
  },
  created() {
    window.addEventListener('keydown', this.navigation)
  },
  beforeDestroy() {
    window.removeEventListener('keydown', this.navigation)
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
  background: $black;
  z-index: 100;
  color: $white;
  display: flex;
  justify-content: space-around;
  align-items: center;
  cursor: pointer;

  &__image {
    object-fit: contain;
    width: calc(100% - (4 * #{$margin-sides}));
    height: auto;
    max-height: calc(100vh - (7 * #{$margin-top}));
    z-index: 99;
  }

  &__nav {
    position: fixed;
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    z-index: 90;

    &__button {
      font-size: 30px;
      margin: 0 $margin-sides;
    }

    &__close {
      font-size: 30px;
      position: fixed;
      bottom: $margin-top;
      width: 100%;
      text-align: center;
    }
  }
}
</style>
