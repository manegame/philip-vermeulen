<template>
  <div class="events" :class="{ popup: close }">
    <span class="events__close"
          v-if='close'
          @click='$emit("close")'
          v-html='"×"'/>

    <template v-if='all'>
      <ul class="events__list" v-for='item in eventsbyProject'>
        <span class="events__list__head" v-if='upcomingItems'>
          Upcoming:
        </span>
        <li class="events__list__item--upcoming" v-for='event in item.events' v-if='event.name[0] && checkDate(event.to) === "future"'>
          <span v-html='event.name[0].text'></span><br/>
          <span>{{event.from | dayMonthYear}}</span>
          – <span>{{event.to | dayMonthYear}}</span>
        </li>
        <li class="events__list__item--tba" v-for='event in item.events' v-if='event.name[0] && checkDate(event.to) === "tba"'>
          <span v-html='item.project'></span> @ <span v-html='event.name[0].text'></span>. Dates TBA
        </li>
        <span class="events__list__head" v-if='pastItems'>
          <br/>Past:
        </span>
        <li class="events__list__item--past" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "past"'>
          <span v-html='event.name[0].text'></span><br/>
          <span>{{event.from | dayMonthYear}}</span>
          – <span>{{event.to | dayMonthYear}}</span>
        </li>
      </ul>
    </template>

    <template v-else>
      <p class="events__head">
        Upcoming events
      </p>

      <ul class="events__list" v-for='item in main.events'>
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "future"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span v-html='item.project'></span> @ <span v-html='event.name[0].text'></span> from <span>{{event.from | dayMonthYear}}</span> to <span>{{event.to | dayMonthYear}}</span>
          </router-link>
        </li>
      </ul>
      <ul class="events__list" v-for='item in main.events'>
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "tba"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span v-html='item.project'></span> @ <span v-html='event.name[0].text + "."'></span> Dates TBA
          </router-link>
        </li>
      </ul>
    </template>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'
import {isFuture, isPast, isEqual, parse} from 'date-fns'

export default {
  name: 'events',
  data() {
    return {
      upcomingItems: false,
      pastItems: false
    }
  },
  props: {
    close: {
      type: Boolean,
      required: false
    },
    all: {
      type: Boolean,
      required: false
    },
    project: {
      type: String,
      required: false
    }
  },
  computed: {
    ...mapState(['main']),
    eventsbyProject() {
      return this.main.events.filter(event => event.project === this.project)
    }
  },
  methods: {
    ...mapActions(['GET_POSTS']),
    checkDate (date) {
      const tba = new Date(1986, 10, 28)
      if (isEqual(parse(tba), parse(date))) {
        this.upcomingItems = true
        return 'tba'
      } else if (isPast(parse(date))) {
        this.pastItems = true
        return 'past'
      } else if (isFuture(parse(date))) {
        this.upcomingItems = true
        return 'future'
      }
    }
  },
  mounted () {
    this.GET_POSTS()
  },
  beforeDestroy() {
    this.upcomingItems = false
    this.pastItems = false
  }
}
</script>

<style lang='scss'>
@import '../style/helpers/_mixins.scss';
@import '../style/helpers/_responsive.scss';
@import '../style/_variables.scss';

.events {
  width: auto;
  margin-bottom: $line-height-s;

  &.popup {
    text-align: center;
    padding: $line-height-s / 2 $line-height * 1.5 $line-height-s / 2;
    background: $theme-r;
    color: $white;
    width: 80%;
    float: left;
    position: relative;
    font-size: $font-size-s;
    line-height: $line-height-s;

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

    .events__list__item {
      padding-left: 0;
    }
  }

  &__list {
    color: $white;

    &__head {
      line-height: $line-height-xs;
      height: $line-height-xs;

      &::before {
        &:not(:first-child) {
          content: '';
          display: block;
          height: $line-height-xs;
        }
      }
    }

    &__item {
      padding-left: $line-height;
      color: $white;
    }
  }
}
</style>
