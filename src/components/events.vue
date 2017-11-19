<template>
  <div class="events">
    <p class="events__head">
      Upcoming Dates
    </p>
    <ul class="events__list">
      <li class="events__list__item" v-for='item in main.projects'>
        <!-- Title from here -->
        <span class="events__list__item__s1" v-for='e in item.data.events'>
        <!-- dates from here -->
          <span class="events__list__item__s1__s2" v-for='a in e.event'>
            <!-- event title from here -->
            <span class="events__list__item__s1__s2__s3" v-if='isUp(e.to)'>
              <router-link class="events__list__item__s1__s2__s3__link" :to="{ name: 'singleProject', params: {slug: item.slugs[0]} }">
                <span class="events__list__item__s1__s2__s3__link__project">{{item.data.title[0].text}}</span> @
                {{a.text}} from
                {{e.from | dayMonthYear}} until
                {{e.to | | dayMonthYear}}<br />
              </router-link>
            </span>
          </span>
        </span>
      </li>
    </ul>
    <span class="events__close" @click='$emit("close")'>close</span>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import moment from 'moment'

export default {
  name: 'events',
  computed: {
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_POSTS']),
    isUp (value) {
      // expects the to value of a event
      let date = moment(value)
      let now = moment()
      if (date > now) {
        return date
      }
    }
  },
  mounted () {
    this.GET_POSTS()
  }
}
</script>

<style lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.events {
  background: $theme-r;
  text-align: center;
  color: $white;
  padding-bottom: $line-height-s / 2;

  &__close {
    cursor: pointer;
  }

  &__head {
    padding-top: $line-height-s;
    color: $black;
  }

  &__list {
    font-size: $font-size-s;
    line-height: $line-height-s;
    padding-top: $line-height-s;
    padding-bottom: $line-height-s;

    &__item {
      &__s1 {
        &__s2 {
          &__s3 {
            &__link {
              color: $white !important;

              &__project {
                color: $black;
              }
            }
          }
        }
      }
    }
  }
}
</style>
