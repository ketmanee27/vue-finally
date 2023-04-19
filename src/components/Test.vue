<template>
  <div  class="lessonmore">
    <!-- <router-link :to="{ name: 'login' }">Detail</router-link> -->
    <!-- <div>{{lesson.lesson_id}}</div> -->
    <!-- , params: { userId: '123' } -->
    <!-- <div>{{lesson.lesson_id}}</div> -->
    <div>{{item.lesson_unit}}</div>
    <div>{{item.lesson_name}}</div>
    <div v-html="item.lesson_description"></div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data: () => ({
    alllesson: [],
    item: '',
    lesson: {
      lesson_id: '',
      lesson_unit: '',
      lesson_name: ''
    },
    lesson_id: '',
    lesson_unit: '',
    lesson_name: ''
    // id: this.$route.params.id
    // return {
    //   id: this.$route.params.id,
    //   lesson: {}
    //   // lessonID: this.$router.params.id }
    // }
  }),
  created () {
    this.lesson_id = this.$route.params.id
    this.getLesson()
  },
  inject: [
    'getLesson'
  ],
  computed: {
    lessonChilren () {
      return this.getLesson
    }
  },
  methods: {
    async getLesson () {
      axios.get('http://localhost/vue-backend/lesson.php?id=this.lesson_id').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.item = res.data[this.lesson_id]
          console.log('item', this.item)
        }
      })
    }
  }
}
</script>

<style>

</style>
