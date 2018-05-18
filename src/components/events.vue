<template>
  <div class="events" 
       :class="{ popup: close, 'about-page': about }" 
       :style='!all ? { background: dynamicColor } : { background: "black" }'>
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
          <span class="events__list__item__title"
                :style='{ color: dynamicColor }'
                v-html='event.name[0].text'></span><br/>
          <span>{{event.from | dayMonthYear}}</span>
          – <span>{{event.to | dayMonthYear}}</span>
        </li>

        <li class="events__list__item--tba" v-for='event in item.events' v-if='event.name[0] && checkDate(event.to) === "tba"'>
          <span class="events__list__item__title"
                :style='{ color: dynamicColor }'
                v-html='event.name[0].text'></span><br/>
          Dates TBA
        </li>

        <span class="events__list__head" v-if='pastItems'>
          Past:
        </span>

        <li class="events__list__item--past" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "past"'>
          <span class="events__list__item__title"
                :style='{ color: dynamicColor }'
                v-html='event.name[0].text'></span><br/>
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
            <span class="events__list__item__title"
                  v-html='item.project'/>
            <span class="events__list__item__location"
                  v-html='"@ " + event.name[0].text'/>
            <br/>
            <span class="events__list__item__date">{{event.from | dayMonthYear}}</span>
            –
            <span class="events__list__item__date">{{event.to | dayMonthYear}}</span>
          </router-link>
        </li>
      </ul>
      <ul class="events__list" v-for='item in main.events'>
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "tba"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span class="events__list__item__title"
                  v-html='item.project'/>
            <span class="events__list__item__location"
                  v-html='"@ " + event.name[0].text + "."'/>
            <br/>
            Dates TBA
          </router-link>
        </li>
      </ul>
    </template>
  </div>
</template>

<script>
import {mapState, mapActions, mapGetters} from 'vuex'
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
    about: {
      type: Boolean,
      required: false
    },
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
    ...mapGetters(['dynamicColor']),
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

  &.about-page {
    .events__head {
      &::after {
        content: '';
        height: $line-height-xs;
        display: block;
      }
    }

    .events__list__item {
      &::after {
        content: '';
        height: $line-height-xs / 2;
        display: block;
      }
    }

    .events__list__item__title,
    .events__list__item__location {
      color: $black;
    }
  }

  &.popup {
    text-align: center;
    padding: $line-height-s / 2 $line-height * 1.5 $line-height-s / 2;
    background: $white;
    color: $white;
    width: 80%;
    float: left;
    position: relative;
    font-size: $font-size-s;
    line-height: $line-height-s;

    @include screen-size('small') {
      font-size: $font-size-xs;
      line-height: $line-height-xs;
    }

    .events__head {
      color: white !important;
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

    .events__list__item__title,
    .events__list__item__location {
      color: black;
    }
  }

  &__list {
    color: $white;

    &__head {
      line-height: $line-height-xs;
      height: $line-height-xs;

      &::after {
        content: '';
        height: $line-height-xs / 2;
        display: block;
      }

      &:not(:first-child) {
        &::before {
          content: ' ';
          display: block;
          height: $line-height-xs;
        }
      }
    }

    &__item {
      padding-left: $line-height;
      color: $white;

      @include screen-size('small') {
        padding-left: $margin-sides / 4;
      }

      &--upcoming,
      &--past,
      &--tba {
        &::after {
          content: '';
          height: $line-height-xs / 2;
          display: block;
        }
      }

      &__title {
        color: $theme-r; /* override by dynamicColor */
      }
    }
  }
}
</style>
