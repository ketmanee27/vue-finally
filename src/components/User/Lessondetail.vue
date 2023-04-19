<template>
  <div>
    <NavbarUser/>
    <div>
    <v-breadcrumbs
      :items="breadcrumbs"
      large
    ></v-breadcrumbs>
  </div>

    <!-- <div>{{item.lesson_unit}}</div>
    <div>{{item.lesson_name}}</div>
    <div>{{item}}</div> -->
    <v-card class="mt-7 mb-7 pa-5">
      <h1 class="text-center ma-5">บทที่ {{ lesson_id}} <span class="teal--text">{{lesson_name}}</span></h1>
    <div class="output ql-snow">
      <div class="ql-editor" v-html="lesson_description"></div>
    </div>
    <v-card  elevation="0" style="border-color:#fcad74; border-width: 2px;" rounded outlined >
      <v-card-title>
        เว็บไซต์ที่เกี่ยวข้อง
      </v-card-title>
      <v-card-subtitle>
        <div  v-for="website in allwebsite" v-bind:key="website.website_id">
      <ul v-if="website.lesson_id === lesson_id">
        <a :href="website.website_link" target="_blank"><li>{{ website.website_name }}</li></a>
        <!-- <li>{{ website.website_link }}</li> -->
      </ul>
    </div>
    <div v-show="website.lesson_id !== lesson_id">
      <p>ไม่พบเว็บไซต์ที่เกี่ยวข้อง</p>
    </div>
    </v-card-subtitle>

    </v-card>
</v-card>
  </div>
</template>

<script>
import axios from 'axios'
import NavbarUser from '@/components/NavbarUser'
// import { all } from 'q'
export default {
  components: {
    NavbarUser
  },
  name: 'quill-example-custom-toolbar',
  title: 'Custom toolbar',
  data () {
    return {
      alllesson: [],
      allwebsite: [],
      website: {
        website_id: ''
      },
      item: '',
      lesson: {
        lesson_id: '',
        lesson_unit: '',
        lesson_name: '',
        lesson_description: ''
      },
      lesson_id: '',
      lesson_unit: '',
      lesson_name: '',
      lesson_description: '',
      breadcrumbs: [
        {
          text: 'หน้าแรก',
          disabled: false,
          to: { name: 'home' }
        },
        {
          text: 'บทเรียน',
          disabled: false,
          // href: 'lesson'
          to: { name: 'lesson' }
        },
        {
          text: 'รายละเอียดบทเรียน',
          disabled: true
          // href: 'lessondetail'
        }
      ]
    }
  },
  created () {
    this.lesson_id = this.$route.params.id
    this.getLesson()
    this.getWebsite()
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
      const url = 'http://localhost/vue-backend/lessonDetail.php?id=' + this.lesson_id
      // alert(url)
      // alert('http://localhost/vue-backend/lesson_detail.php?id=', this.lesson_id)

      axios.get(url).then((response) => {
        console.log(response)
        this.info = response.data[0]
        // alert(this.info)
        this.lesson_id = this.info.lesson_id
        this.lesson_name = this.info.lesson_name
        this.lesson_description = this.info.lesson_description
      }).then(response => (
        this.info = response
      ))
      /*
      axios.post(url, {
        request: 1

      })
        .then(function (response) {
          alert('work')
          this.data = response.data[0]
          alert(response.data.status)
          // alert(this.data.status)
        })
      */
    },
    async getWebsite () {
      axios.get('http://localhost/vue-backend/website.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allwebsite = res.data
          console.log(this.allwebsite, 'เว็บไซต์')
        }
      })
    }
  }
}
</script>

<style scoped>

.v-breadcrumbs >>> a {
    color: #fcad74 !important;
}
</style>
