<template>
  <div class="overview">
    <div class="overview__project" v-for="project in main.projects">
      <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }">
        <img class="overview__project__image" :src="project.data.preview_image.url"/>
      </router-link>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import headbar from '../components/headbar'

export default {
  name: 'overview',
  components: {
    headbar
  },
  data() {
    return {
      msg: 'overview'
    }
  },
  computed: {
    ...mapState(['main'])
  },
  head: {
    title() {
      return {
        inner: this.title
      }
    }
  },
  methods: {
    ...mapActions(['GET_POSTS'])
  },
  mounted() {
    this.GET_POSTS()
  },
  watch: {
    $route(to, from) {}
  }
}
</script>

<style scoped lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.overview {
  padding: $margin-top $margin-sides;
  width: 100%;
  height: 100%;
  z-index: 0;

  &__project {
    height: $line-height * 9;
    width: auto;
    margin-top: $line-height;
    clear: none;
    z-index: 1;

    &:nth-child(even) {
      float: right;
      clear: right;
      margin-top: $line-height * 2;
    }

    &:nth-child(odd) {
      float: left;
      clear: left;
      margin-top: $line-height * 3;
    }

    &:nth-child(2) {
      margin-top: $line-height * 5;
    }

    &__image {
      height: 100%;
      width: auto;
    }
  }
}
</style>
