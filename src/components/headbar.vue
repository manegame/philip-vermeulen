<template>
  <div class="headbar">
    <div class="headbar__columns">

      <div class="headbar__columns__column--l">
        <router-link class="headbar__columns__column--l__link" to="/">Philip Vermeulen</router-link>
      </div>

      <div class="headbar__columns__column--m">
        <router-link v-if='showTitle' :to="{ name: 'singleProject', params: {slug: variables.project.slug} }">{{variables.project.title}}</router-link>
      </div>

      <div class="headbar__columns__column--r">
        <router-link class="headbar__columns__column--r__link" :to="{name: 'about'}">About</router-link>
      </div>

    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
export default {
  name: 'headbar',
  props: {
    showTitle: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
      show: this.showTitle
    }
  },
  computed: {
    ...mapState(['main', 'variables'])
  },
  methods: {
    ...mapActions(['GET_POSTS'])
  }
}
</script>

<style lang="scss">
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.headbar {
  position: fixed;
  width: 100%;
  padding: $margin-top $margin-sides;
  z-index: 0;

  @include screen-size('small') {
    padding: $margin-top $line-height-s;
  }

  &__columns {
    display: inline-flex;
    flex-direction: row;
    justify-content: space-between;
    width: 100%;

    &__column {
      &--l,
      &--m,
      &--r {
        width: 33%;
      }

      &--l {
        text-align: left;

        &__link {
          color: $white;

          &:visited,
          &:active {
            color: $white;
          }
        }

        &__span {
          color: $white;

          &:visited,
          &:active {
            color: $white;
          }
        }
      }

      &--m {
        text-align: center;

        @include screen-size('small') {
          display: none;
        }
      }

      &--r {
        text-align: right;

        &__link {
          color: $theme-r;

          &:visited,
          &:active {
            color: $theme-r;
          }
        }

        &__span {
          color: $theme-r;

          &:visited,
          &:active {
            color: $theme-r;
          }
        }
      }
    }
  }
}
</style>
