<template>
  <div  class='pdf'
        :style='{ backgroundColor: dynamicColor }'>
    <a  href='http://philipvermeulen.com/pdf/Catalogus_RIJKS_PHI.pdf'
        class='pdf__link'>
      <img  class='pdf__link__image' 
            src='../assets/img/1.jpg'/>
    </a>
    <a  href='http://philipvermeulen.com/pdf/PHI_brewingthesublime_digitaal.pdf'
        class='pdf__link'>
      <img  class='pdf__link__image'
            src='../assets/img/2.jpg'/>
    </a>
  </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  name: 'pdf',
  computed: {
    ...mapGetters(['dynamicColor'])
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
