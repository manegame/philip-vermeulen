<template>
  <div  class='pdf'
        :style='{ backgroundColor: dynamicColor }'>
    <template v-if='main.library.data.files.length > 0'
              v-for='file in main.library.data.files'>
      <a  class='pdf__link'
          :href='file.file.url'
          :key='file.file.size'>
        <img  class='pdf__link__image'
              v-if='file.cover.url'
              :src='file.cover.url' />
        <p v-else>{{file.file.name}}</p>
      </a>
    </template>
  </div>
</template>

<script>
import {mapActions, mapGetters, mapState} from 'vuex'

export default {
  name: 'pdf',
  computed: {
    ...mapGetters(['dynamicColor']),
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_LIBRARY'])
  },
  mounted() {
    this.GET_LIBRARY()
  }
}
</script>

<style lang='scss'>
@import "../style/helpers/_mixins.scss";
@import "../style/helpers/_responsive.scss";
@import "../style/helpers/_reset.css";
@import "../style/_variables.scss";
@import "../style/_typography.scss";

.pdf {
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: row nowrap;
  justify-content: flex-start;
  padding: $margin-top * 3 0;

  @include screen-size('small') {
    flex-direction: column;
    height: auto;
  }

  &__link {
    padding: $margin-top 0 $margin-top $margin-sides;
    width: auto;
    max-height: 70%;

    @include screen-size('small') {
      padding: $margin-top $line-height-s;
      width: 100%;
      height: 70vh;
    }

    &__image {
      max-width: 100%;
      height: 100%;
      object-fit: contain;
      object-position: top left;
    }
  }
}
</style>
