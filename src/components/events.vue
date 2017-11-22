<template>
  <div class="events" :class="{ popup: close }">
    <span v-if='close' class="events__close" @click='$emit("close")'>×</span>
    <p class="events__head">
      Upcoming Dates
    </p>
    <ul class="events__list">
      <li class="events__list__item" v-for='item in main.projects'>
        <!-- Title from here -->
        <span class="events__list__item__s1" v-for='e in item.data.events'>
        <!-- dates from here -->
          <span class="events__list__item__s1__s2" v-for='a in e.name'>
            <!-- event title from here -->
            <span class="events__list__item__s1__s2__s3">

              <router-link class="events__list__item__s1__s2__s3__link" :to="{ name: 'singleProject', params: {slug: item.slugs[0]} }" v-if='isUp(e.to)'>
                <span class="events__list__item__s1__s2__s3__link__project">{{item.data.title[0].text}}@ {{a.text}}</span><br/>
                from {{e.from | dayMonthYear}} until {{e.to | dayMonthYear}}<br />
              </router-link>

              <router-link class="events__list__item__s1__s2__s3__link" :to="{ name: 'singleProject', params: {slug: item.slugs[0]} }" v-else-if='isTba(e.to)'>
                <span class="events__list__item__s1__s2__s3__link__project">{{item.data.title[0].text}} @ {{a.text}}<br/></span>
                Dates TBA
              </router-link>
            </span>
          </span>
        </span>
      </li>
    </ul>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import moment from 'moment'

export default {
  name: 'events',
  props: {
    close: {
      type: Boolean,
      required: true
    }
  },
  computed: {
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_POSTS']),
    isUp (value) {
      // expects the to value of a event
      let date = moment(value)
      let tba = moment('11-28-1986')
      let now = moment()
      if (date.diff(now, 'days') > 0) return true
      else return false
    },
    isTba (value) {
      let date = moment(value)
      let tba = moment('11-28-1986')
      if (date.diff(tba, 'days') === 0) {
        return true
      }
    },
    getDate (value) {
      let date = moment(value)
      if (this.isUp(value)) {
        return date
      }
    }
  },
  mounted () {
    this.GET_POSTS()
    console.log('check', this.isUp('09-11-2017'))
    console.log('check', this.isUp('11-28-2017'))
  }
}
</script>

<style lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.events {
  width: auto;
  text-align: center;
  padding: $line-height-s / 2 $line-height $line-height-s / 2 $line-height;
  margin-bottom: 0;
  background: $white;
  color: $black;

  &.popup {
    background: $theme-r;
    color: $white;
    width: 80%;
    float: right;
    position: relative;

    .events__head {
      color: black !important;
      padding-bottom: $line-height / 2;
    }

    .events__close {
      position: absolute;
      left: $line-height;
      top: $line-height / 2;
      width: 100%;
      text-align: left;
      cursor: pointer;
      color: $black;
    }
  }

  &__head {
    color: $black;
  }

  &__list {
    font-size: $font-size-s;
    line-height: $line-height-s;

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
