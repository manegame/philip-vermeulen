<template>
  <div class="events">
    <ul>
      <li v-for='item in main.projects' v-html='getEvents(item)'></li>
    </ul>
  </div>
</template>

<script>
import {mapState, mapActions} from 'vuex'

export default {
  name: 'events',
  computed: {
    ...mapState(['main'])
  },
  methods: {
    ...mapActions(['GET_POSTS']),
    getEvents (data) {
      console.log('THIS IS THE DATA', data)
      let result = Object.keys(data)
        .map(key => data[key]) // turn an array of keys into array of items.
        .filter(data => data.from)

      console.log(result)
      return result
    }
  },
  mounted () {
    this.GET_POSTS()
  }
}
</script>

<style>
  .events {
    color: blue;
  }
</style>
