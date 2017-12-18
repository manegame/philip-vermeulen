<template>
  <div class="events" :class="{ popup: close }">
    <span v-if='close' class="events__close" @click='$emit("close")'>×</span>

    <p class="events__head">
      Upcoming Dates
    </p>

    <template v-if='all'>
      Upcoming and past DATES
      <!-- <ul class="events__list" v-for='item in main.events'>
        Upcoming
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "future"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span v-html='item.project'></span> @ <span v-html='event.name[0].text'></span> from <span v-html='event.from'></span> to <span v-html='event.to'></span>
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

      <ul class="events__list" v-for='item in main.events'>
        Past
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "past"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span v-html='item.project'></span> @ <span v-html='event.name[0].text + "."'></span> Dates TBA
          </router-link>
        </li>
      </ul> -->
    </template>

    <template v-else>
      <ul class="events__list" v-for='item in main.events'>
        <li class="events__list__item" v-for='event in item.events'  v-if='event.name[0] && checkDate(event.to) === "future"'>
          <router-link :to="{name: 'singleProject', params: {slug: item.slug}}">
            <span v-html='item.project'></span> @ <span v-html='event.name[0].text'></span> from <span v-html='event.from'></span> to <span v-html='event.to'></span>
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
  props: {
    close: {
      type: Boolean,
      required: false
    },
    all: {
      type: Boolean,
      required: false
    }
  },
  computed: {
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_POSTS']),
    checkDate (date) {
      let tba = new Date(1986, 10, 28)
      console.log(parse(tba), parse(date))
      if (isEqual(parse(tba), parse(date))) return 'tba'
      else if (isPast(parse(date))) return 'past'
      else if (isFuture(parse(date))) return 'future'
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

  &__head {
    color: $black;
  }

  &__list {
    &__item {
      padding-left: $line-height;
      color: $white;
    }
  }
}
</style>
