<template>
  <div>
    <NavbarUser/>
    <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            ลำดับบทเรียน
          </th>
          <th class="text-left">
            ชื่อบทเรียน
          </th>
          <th class="text-left">
          </th>
          <!-- <th class="text-left">
            {{lesson.lesson_name}}
          </th> -->
        </tr>
      </thead>
      <tbody>
        <tr v-for="lesson in alllesson" v-bind:key="lesson.lesson_id" class="lessonmore">
          <!-- <td>{{lesson.lesson_id}}</td> -->
          <td>{{lesson.lesson_unit}}</td>
          <td>{{lesson.lesson_name}}</td>
          <td>
            <!-- <a href="Quizlesson" text color="#FAD234"> -->
              <!-- <router-link to="/test/">test</router-link> -->
            <!-- <v-btn
              text
              color="primary"
              @click="linkDetail(lesson.lesson_id)"
              >
            ทำข้อสอบ
          </v-btn> -->

          <router-link v-bind:to="'/lessondetail/'+ lesson.lesson_unit"><div>click</div></router-link>
          <!-- <router-link v-bind:to="'/test/'+ lesson.lesson_id"><div>click</div></router-link> -->
          <!-- </a> -->
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
  </div>
</template>

<script>
import axios from 'axios'
import NavbarUser from '@/components/NavbarUser'
export default {
  components: {
    NavbarUser
  },
  data: () => ({
    alllesson: [],
    lesson: {
      lesson_id: '',
      lesson_unit: '',
      lesson_name: ''
    },
    headers: [
      {
        text: 'บทที่',
        align: 'start',
        value: 'lesson_unit'
      },
      { text: 'บทเรียนเรื่อง', value: 'lesson_name' },
      // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
      // { text: 'แก้ไข', value: 'edit', sortable: false },
      { text: '', value: 'delete', sortable: false }

    ]
  }),
  created () {
    this.getLesson()
  },
  methods: {
    async getLesson () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/lesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    }
  }
}
</script>

<style>

</style>
