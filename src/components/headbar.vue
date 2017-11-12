<template>
  <div class="headbar">
    <div class="headbar__columns">
      <div class="headbar__columns__column--l">
        <router-link class="headbar__columns__column--l__link" to="/">Philip Vermeulen</router-link>
      </div>
      <div class="headbar__columns__column--m">
          {{variables.title}}
        <!-- <ul class="headbar__columns__column__list" v-for="(project, index) in main.projects">
          <li>
            {{index + 1}}.
          </li>
          <li class="headbar__columns__column__list__item" v-if="isEven((index + 1))">
            <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
            <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }">show </router-link>
            <span v-html='project.data.title[0].text'></span>
          </li>
          <li v-else>
            <span v-html='project.data.title[0].text'></span>
            <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }">show </router-link>
            <router-link :to="{ name: 'singleProject', params: {slug: project.slugs[0]} }" v-html='project.data.title[0].text'></router-link>
          </li>
        </ul> -->
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
  z-index: 1;
  pointer-events: none;

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
