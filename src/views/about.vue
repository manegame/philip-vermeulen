<template>
  <div class="about">
    <div class="about__text">
      <p>{{this.main.about[0].data.text[0].text}}</p>
    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import PrismicDOM from 'prismic-dom'

export default {
  name: 'about',
  data() {
    return {
      msg: 'about'
    }
  },
  computed: {
    ...mapState(['main']),
    renderHTML() {
      return PrismicDOM.RichText.asHtml(this.main.about[0].data.text[0].text, doc => doc)
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
    ...mapActions(['GET_POSTS'])
  },
  mounted() {
    this.GET_POSTS()
    //   .then(() => {
    //     this.setContent()
    //   })
  },
  watch: {
    '$route' (to, from) {
      // this.setContent()
    }
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
  overflow-y: hidden;
  z-index: 0;
  padding: $margin-top * 9 $margin-sides;
  font-size: 20px;
  line-height: 24px;
  background: $theme;
  color: $white;
}

</style>
