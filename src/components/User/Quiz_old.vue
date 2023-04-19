<template>
<div>
  <NavbarUser/>
  <div>
    <v-breadcrumbs
      :items="breadcrumbs"
      large
    ></v-breadcrumbs>
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

  <v-simple-table
  fixed-header
    height="350px">
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
          <td class="text-left">{{lesson.lesson_id}}</td>
          <td class="text-left">{{lesson.lesson_name}}</td>
          <td class="text-left">
            <!-- <a href="Quizlesson" text color="#FAD234"> -->
              <!-- <router-link to="/test/">test</router-link> -->
              <router-link v-bind:to="'/quiz/posttest/'+ lesson.lesson_id">
                <v-btn
                  color="#fcad74"
                  text
                >
                ทำข้อสอบ
                </v-btn>
              </router-link>
            <!-- <v-btn
              text
              color="primary"
              @click="linkDetail(lesson.lesson_id)"
              >
            ทำข้อสอบ
          </v-btn> -->
          <!-- <router-link v-bind:to="'/test/'+ lesson.lesson_id"><div>click</div></router-link> -->
          <!-- </a> -->
          </td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
  </v-card>
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
    reveal: false,
    alllesson: [],
    lesson: {
      lesson_id: '',
      lesson_unit: '',
      lesson_name: ''
    },
    valid: false,
    search: '',
    click: 'คลิ๊กเพื่อทำแบบทดสอบ',
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

    ],
    data: [],
    breadcrumbs: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'home'
      },
      {
        text: 'แบบทดสอบ',
        disabled: true,
        href: 'quiz'
      }
    ]

  }),
  created () {
    this.getLesson()
  },
  // provide () {
  //   return {
  //     getLesson: this.lessonMore
  //   }
  // },
  // computed: {
  //   lessonMore () {
  //     return this.lessonMore
  //   }
  // },
  // mounted () {
  //   this.$emit('test', true)
  // },
  methods: {
    async getLesson () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/lesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    linkDetail (data) {
      console.log(data, 'id จ้า')
      this.$router.push({ name: 'quizlesson', params: { id: data } })
      // this.$router.push({ name: 'test', params: { id: data } })
    }
  }

}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');
*{
font-family: 'Prompt', sans-serif;
}
.text-h4 {
  text-align: center;
  font-size: 20px;
}
.mt-0{
  margin-top: -10px;
  text-align: center;
}
h1{
  color: #000;
}
.img1 {
 width: 500px;
 height: 100px;
 text-align: center;
}
.mx{
  margin-top: 40px;
  height: 400px;
  padding: 20px;
  margin-left: auto;
  margin-right: auto;
}

.text-center{
  font-size: 25px;
  font-style: bold;
  padding: 15px;
  color: #56a062;
}
.text-title{
  text-align: center;
  padding: 15px;
  font-size: 1.3em !important;
  color: rgb(75, 75, 75);
}
a{
  text-decoration:none;
}
.lesson{
  text-align: center;
  margin-top: 30px;
}

.v-card {
  transition: opacity .5s ease-in-out rgb(255, 255, 107) ;
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
.mx{
  margin-top: 100px;
  height: 250px;
  padding: 20px;
  margin-left: auto;
  margin-right: auto;
}
.text-center{
  font-size: 25px;
  font-style: bold;
  padding: 15px;
}
a{
  text-decoration:none;
  text-align: center;
  color: #56a062;
}
.quiz{
text-align: center;
}
.v-breadcrumbs >>> a {
    color: #fcad74;
}

</style>
