<template>
<div >
  <NavbarUser/>
  <div>
    <v-breadcrumbs
      :items="breadcrumbs"
      large
    ></v-breadcrumbs>
  </div>
      <h1 class="mt-0 mb-7" align="center">บทเรียน</h1>
      <div class="row">
        <div class="col-md-12">
<v-row>
<v-col cols="12"
                sm="6"
                md="3"
                v-for="lesson in alllesson" v-bind:key="lesson.lesson_id">

  <v-card
    class="mx-auto"
    max-width="400"
    >

    <v-img
      class="white--text align-end"
      height="200px"
      :src="lesson.lesson_unitimg">
      <v-card-title>บทที่ {{lesson.lesson_id}}</v-card-title>
    </v-img>

    <!-- <v-card-subtitle class="pb-0">
      Number 10
    </v-card-subtitle> -->

    <v-card-text class="text--primary">
      <div>{{lesson.lesson_name}}</div>
    </v-card-text>

    <v-card-actions>
      <router-link v-bind:to="'/lessondetail/'+ lesson.lesson_id">
      <v-btn
        color="#fcad74"
        outlined
      >
      อ่านเพิ่มเติม
      </v-btn>
    </router-link>

    </v-card-actions>
  </v-card>
</v-col>

  </v-row>
  </div>
  </div>

  <!-- <v-container>
      <div class="row">
        <div class="col-md-12">
<v-row>
<v-col cols="12"
                sm="6"
                md="3"
                v-for="lesson in alllesson" v-bind:key="lesson.lesson_id">
    <v-card-text>
      <v-hover v-slot="{ hover }">
        <v-card class="mx" max-width="300" max-height="350" :elevation="hover ? 12 : 2"
              :class="{ 'on-hover': hover }">
      <div class="text-center mt-0">บทที่ {{lesson.lesson_unit}}</div>
      <p class="text-title">{{lesson.lesson_name}}</p>
      <p></p>
      <v-img
        class="img1"
        contain
        src="https://scontent.xx.fbcdn.net/v/t1.15752-9/274128906_464298895175854_6909789807726120927_n.png?_nc_cat=109&ccb=1-5&_nc_sid=aee45a&_nc_ohc=Ox9C9g1_u2EAX98OZU7&_nc_ad=z-m&_nc_cid=0&_nc_ht=scontent.xx&oh=03_AVLjK1MmKcGBo2uF_NBU06i4HKeT9g3g_I7rKIbwNY8vdw&oe=624901F2"
        transition="scale-transition"
        width="200"
      />
      <center>
      <a href="lessonmore" text color="teal accent-4" @click="sendData(user)" >
        อ่านเพิ่มเติม
      </a></center>
      </v-card>
          </v-hover>
    </v-card-text>
  </v-col>

  </v-row>
  </div>
  </div>
  </v-container> -->
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
    // lesson_id: '',
    // lesson_unit: '',
    // lesson_name: '',
    lesson: {
      lesson_unit: '',
      lesson_name: ''
    },
    breadcrumbs: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'home'
      },
      {
        text: 'บทเรียน',
        disabled: true,
        href: 'lesson'
      }
    ]
  }),
  created () {
    this.getLesson()
  },
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
h1{
  color: #000;
}
.img1 {
 width: 500px;
 height: 100px;
 text-align: center;
}
.mx {
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
  text-align: center;
}
.text-title{
  text-align: center;
  padding: 15px;
  font-size: 1.3em !important;
  color: rgb(75, 75, 75);
}
a{
  text-decoration:none;
  text-align: center;
  color: #56a062;
}
.lesson{
  text-align: center;
  margin-top: 30px;
}

.v-card {
  transition: opacity .5s ease-in-out rgb(255, 255, 107) ;
    box-shadow: 1px 1px 9px 9px lightblue;
}

.show-btns {
  color: #feedb0 !important;
  box-shadow: 10px 10px 5px 12px lightblue;
}
.v-breadcrumbs >>> a {
    color: #fcad74;
}
</style>
