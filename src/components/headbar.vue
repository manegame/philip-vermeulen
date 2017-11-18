<template>
  <div class="headbar">
    <div class="headbar__columns">

      <div class="headbar__columns__column--l">
        <router-link class="headbar__columns__column--l__link" to="/" @click='showTitle = true'>Philip Vermeulen</router-link>
      </div>

      <div class="headbar__columns__column--m">
        <router-link v-if='showTitle' :to="{ name: 'singleProject', params: {slug: variables.project.slug} }">{{variables.project.title}}</router-link>
      </div>

      <div class="headbar__columns__column--r">
        <router-link class="headbar__columns__column--r__link" :to="{name: 'about'}" @click='showTitle = false'>About</router-link>
      </div>

    </div>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
export default {
  name: 'headbar',
  data () {
    return {
      showTitle: true
    }
  },
  computed: {
    ...mapState(['main', 'variables'])
  },
  methods: {
    ...mapActions(['GET_POSTS'])
  },
  watch: {
    '$route' (to, from) {
      console.log('we zijn nu hier', this.$route)
      if (this.$route.name === 'overview') { this.showTitle = true }
      if (this.$route.name === 'singleProject') { this.showTitle = false }
      if (this.$route.name === 'about') { this.showTitle = false }
    }
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
  z-index: 1;

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
          color: $theme;

          &:visited,
          &:active {
            color: $theme;
          }
        }

        &__span {
          color: $theme;

          &:visited,
          &:active {
            color: $theme;
          }
        }
      }
    }
  }
}
</style>
