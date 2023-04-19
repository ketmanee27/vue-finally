<template>
  <div>
    <NavbarAdmin />
    <div>
      <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
    </div>
    <h1 class="mt-7 mb-7" align="center">แบบทดสอบ</h1>

    <!-- <v-card class="cardShowuser">
    <v-card-title>
      <v-icon class="mr-2" color="#fcad74">mdi-book-open-variant</v-icon>
     บทเรียน
      <v-spacer></v-spacer>
<v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        dense
        color="#099fae"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-card-title>
      <v-spacer></v-spacer>
    <v-btn
      class="mx-2"
      fab
      dark
      small
      color="#099fae"
      @click="insertItem(lesson)"

    >
      <v-icon dark
      >
        mdi-plus
      </v-icon>
    </v-btn>
    </v-card-title>
    <v-card-title>friend</v-card-title>
       <v-data-table :items="alllesson" :headers="headers" :items-per-page="10" :search="search">
       <template slot="data">
          <td>{{lesson_unit}}</td>
        <td>{{lesson_name}}</td>
      </template>
      <template v-slot:item.delete="{ item }">
        <v-icon
        small
        @click="deleteItem(item)"
        color="#ea5859"
        href="login"
      >
        mdi-delete
      </v-icon>
      </template>
    </v-data-table>
    </v-card> -->
    <!-- <v-row>
<v-col cols="12"
                sm="6"
                md="3"
                v-for="lesson in alllesson" v-bind:key="lesson.lesson_id">
  <v-card class="mx" max-width="250">
  <v-card-text>
      <div class="text-center mt-0">บทที่ {{lesson.lesson_unit}}</div>
      <p class="text-title">{{lesson.lesson_name}}</p>
    </v-card-text>
    <v-card-actions>
      <center>
      <a href="Quizlesson" text color="#FAD234" >
        คลิ๊กเพื่อทำข้อสอบ
      </a></center>
      </v-card-actions>
  </v-card>
  </v-col>
  </v-row> -->

    <v-card class="cardShowuser mt-0">

        <template v-slot:default>
          <div class="container">
            <!-- {{url='http://localhost/faq1/oq/login_auth.php?username='+user.user_email+'&password='+user.user_password }} -->
            <router-link v-bind:to="'/lessondetail/'+ lesson.lesson_id">
    </router-link>
    <!--
            <a :href="' <a :href="website.website_link" target="_blank"><li>{{ website.website_link }}</li></a>" width="100%"  height="1024px" frameborder="0">test</a>
            -->
            <v-btn class="button"  style="background-color: #099fae !important;
  color: #fff; margin-bottom:15px" ><a :href="allwebsite" target="_blank" style="color: #fff;">จัดการแบบทดสอบ</a></v-btn>
            <v-row>
      <v-col cols="12" md="12">
        <v-img src="../../assets/imgquiz.png" contain margin-top="10px"></v-img>
      </v-col>
    </v-row>
            <!-- <iframe src="{{url='http://localhost/faq1/oq/login_auth.php?username='+user.user_email+'&password='+user.user_password }}" width="100%"  height="1024px" frameborder="0">
            </iframe> -->
            <!-- <a :href="website.website_link" target="_blank"><li>{{ website.website_link }}</li></a> -->

          </div>
        </template>
    </v-card>
  </div>
</template>

<script>
import axios from 'axios'
import NavbarAdmin from '@/components/NavbarAdmin'

import dedent from 'dedent'
import hljs from 'highlight.js'

// highlight.js style
import 'highlight.js/styles/tomorrow.css'

export default {
  title: 'Theme: snow',
  components: {
    NavbarAdmin
  },
  data () {
    return {
      user: {
        user_id: localStorage.getItem('id'),
        user_firstname: localStorage.getItem('user_firstname'),
        user_lastname: localStorage.getItem('user_lastname'),
        user_email: localStorage.getItem('user_email'),
        user_password: localStorage.getItem('user_password'),
        user_age: localStorage.getItem('user_age'),
        user_birthday: localStorage.getItem('user_birthday'),
        user_district: localStorage.getItem('user_district'),
        user_province: localStorage.getItem('user_province'),
        user_type: localStorage.getItem('type'),
        create_at: localStorage.getItem('create_at')
      },
      dialog: false,
      dialog1: false,
      alllesson: [],
      lesson_id: '',
      lesson_name: '',
      lesson_description: '',
      lesson: {
        lesson_name: '',
        lesson_description: ''
      },
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'admindashboard'
        },
        {
          text: 'จัดการแบบทดสอบ',
          disabled: true,
          href: 'adminquiz'
        }
      ],
      valid: false,
      valid2: false,
      search: '',
      headers: [
        {
          text: 'บทที่',
          align: 'start',
          value: 'lesson_id'
        },
        { text: 'บทเรียนเรื่อง', value: 'lesson_name' },
        // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
        { text: '', value: 'edit', sortable: false }
      ],
      data: [],
      editorOption: {
        modules: {
          toolbar: [
            ['bold', 'italic', 'underline', 'strike'],
            ['blockquote', 'code-block'],
            [{ header: 1 }, { header: 2 }],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ script: 'sub' }, { script: 'super' }],
            [{ indent: '-1' }, { indent: '+1' }],
            [{ direction: 'rtl' }],
            [{ size: ['small', false, 'large', 'huge'] }],
            [{ header: [1, 2, 3, 4, 5, 6, false] }],
            [{ font: [] }],
            [{ color: [] }, { background: [] }],
            [{ align: [] }],
            ['clean'],
            ['link', 'image', 'video']
          ],
          syntax: {
            highlight: text => hljs.highlightAuto(text).value
          }
        }
      },
      content: dedent``
    }
  },
  created () {
    this.getLesson()
  },
  methods: {
    async getLesson () {
      console.log('rewload')
      // alert(this.user.user_email)
      // alert(this.user.user_password)
      this.allwebsite = 'http://localhost/faq1/oq/login_auth.php?username=' + this.user.user_email + '&password=' + this.user.user_password
      axios.get('http://localhost/vue-backend/lesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    linkDetail (data) {
      console.log(data, 'id จ้า')
      this.$router.push({ name: 'admininsertquiz', params: { id: data.lesson_id } })
      // this.$router.push({ name: 'test', params: { id: data } })
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');

* {
  font-family: 'Prompt', sans-serif;
}

.text-h4 {
  text-align: center;
  font-size: 20px;
}

.mt-0 {
  margin-top: -10px;
  text-align: center;
}

h1 {
  color: #000;
}

.img1 {
  width: 500px;
  height: 100px;
  text-align: center;
}

.mx {
  margin-top: 40px;
  height: 400px;
  padding: 20px;
  margin-left: auto;
  margin-right: auto;
}

.text-center {
  font-size: 25px;
  font-style: bold;
  padding: 15px;
  color: #56a062;
}
.button:hover {
  box-shadow: 0 10px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
border-radius: 8px;
}
.text-title {
  text-align: center;
  padding: 15px;
  font-size: 1.3em !important;
  color: rgb(75, 75, 75);
}

a {
  text-decoration: none;
}

.lesson {
  text-align: center;
  margin-top: 30px;
}

.v-card {
  transition: opacity .5s ease-in-out rgb(255, 255, 107);
}

.v-card:not(.on-hover) {
  box-shadow: 1px 1px 10px px rgb(179, 179, 149);
}

.show-btns {
  color: #feedb0 !important;
  box-shadow: 10px 10px 5px 12px lightblue;
}

.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}

.text-h4 {
  text-align: center;
  font-size: 20px;
}

.img1 {
  width: 500px;
  height: 100px;
  text-align: center;
}

.mx {
  margin-top: 100px;
  height: 250px;
  padding: 20px;
  margin-left: auto;
  margin-right: auto;
}

.text-center {
  font-size: 25px;
  font-style: bold;
  padding: 15px;
}

a {
  text-decoration: none;
  text-align: center;
  color: #56a062;
}

.quiz {
  text-align: center;
}

.v-breadcrumbs>>>a {
  color: #fcad74;
}
</style>
