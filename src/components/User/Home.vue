<template>
  <div class="app">
    <NavbarUser />
    <div>
      <div>
        <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
      </div>
      <v-row>
        <v-col cols="12" md="12">
          <v-img src="../../assets/slide1.png" contain margin="0"></v-img>
        </v-col>
      </v-row>
      <template>
        <v-row>
          <v-col cols="12">
            <v-card elevation="0">
              <v-card-text>
                <p style="font-size: 30px; color: #f49300">
                  E-learning for Raising Native Laying Hens
                </p>
                <hr />
                <div class="text--primary mt-10 text-justify" margin-top="15px">
                  เว็บแอปพลิเคชันการให้ความรู้การเลี้ยงไก่ไข่พื้นเมืองและ
                  แบบทดสอบความรู้ความเข้าใจ อาจารย์ผู้สอน รศ.ดร. สจี กัณหาเรียง
                </div>
              </v-card-text>
            </v-card>
          </v-col>
          <v-col cols="12">
            <v-card elevation="0">
              <v-card-text>
                <p style="font-size: 30px; color: #f49300">
                  ความรู้เบื้องต้น การเลี้ยงไก่
                </p>
                <hr />
                <div class="text--primary mt-10 text-justify" margin-top="15px">
                  ไก่พื้นเมือง เป็นสัตว์ปีกท้องถิ่นที่มีลักษณะเด่น คือ
                  เลี้ยงง่าย มีความสามารถในการปรับ ตัวเข้ากับสภาพแวดล้อมได้ดี
                  มีความทนต่อโรคระบาดที่สำคัญในสัตว์ปีกได้ดี หากินเก่ง
                  ใช้อาหารคุณภาพต่ำได้ดี
                  รวมถึงมีความต้านทานความเครียดเนื่องจากความร้อน (heat stress)
                  ได้ดีกว่าสายพันธุ์ที่นำเข้าจากต่างประเทศ (เกรียงไกร และคณะ,
                  2543) จึงทำให้
                  เกษตรกรจำนวนมากนิยมเลี้ยงไก่พื้นเมืองเพิ่มมากขึ้น
                  และปัจจุบันจำนวนเฉลี่ยประชากรไก่ พื้นเมืองต่อจำนวนประชากรคนไทย
                  และจำนวนไก่พื้นเมืองต่อครัวเรือนมีแนวโน้มเพิ่มขึ้นทุก ปี
                  รวมถึงไก่พื้นเมืองถือเป็นส่วนหนึ่งของความมั่นคงด้านอาหารของประเทศ
                  ในอนาคตไก่ พื้นเมืองไทยน่าจะเป็นอาชีพของเกษตรกรได้ (บัญญัติ
                  และมนต์ชัย, 2555)
                </div>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </template>
      <v-toolbar flat color="rgba(0,0,0,0)" dense class="mt-10 mb-10">
        <v-toolbar-title>เนื้อหาการเรียนรู้</v-toolbar-title>
        <v-spacer></v-spacer>
        <a href="/lesson"><span class="black--text">ดูบทเรียนทั้งหมด</span></a>
      </v-toolbar>
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
      class="black--text align-end"
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
    <v-toolbar flat color="rgba(0,0,0,0)" dense class="mt-10 mb-10">
        <v-toolbar-title>เกี่ยวกับเรา</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
       <v-container>
        <v-row class="justify-center align-center">
    <v-col cols="12" sm="6"
                md="4">
                <v-img
                style="border-radius: 50%; "
      class="black--text align-end"
      src="../../assets/teacher.jpg">
    </v-img>
    </v-col>
    <v-col cols="12" sm="6"
                md="8">
                <p><v-icon class="mr-3" color="#099fae">mdi-account</v-icon>อาจารย์ผู้สอน :<span> รศ.ดร. สจี กัณหาเรียง</span></p>
                <p><v-icon class="mr-3" color="#099fae">mdi-map-marker</v-icon>ติดต่อ :<span> สาขาสัตวศาสตร์ คณะเกษตรศาสตร์ มหาวิทยาลัยขอนแก่น</span></p>
                <p><v-icon class="mr-3" color="#099fae">mdi-email</v-icon>อีเมล :<span> ksajee@kku.ac.th</span></p>
                </v-col>
  </v-row>
  </v-container>
      <!-- <div class="px-7">
        <v-hover v-slot="{ hover }" open-delay="200">
          <vueper-slides
            slide-image-inside
            :elevation="hover ? 12 : 2"
            :class="{ 'on-hover': hover }"
            :infinite="false"
            class="no-shadow"
            :visible-slides="4"
            slide-multiple
            :gap="3"
            :slide-ratio="1 / 4"
            :dragging-distance="200"
            :breakpoints="{ 800: { visibleSlides: 2, slideMultiple: 2 } }"
          >
            <template #arrow-left>
              <v-icon class="mr-n15">fas fa-chevron-left</v-icon>
            </template>

            <template #arrow-right>
              <v-icon class="ml-n15">fas fa-chevron-right</v-icon>
            </template>
            <vueper-slide
              v-for="(slide, i) in slides"
              :key="i"
              :image="slide.src"
              :title="slide.title"
              :link="slide.link"
              :style="'background-color: ' + ['#099fae', '#F49300'][i % 2]"
            />
          </vueper-slides>
        </v-hover>
      </div> -->
      <v-row class="footer" style="margin-top: 5%">
        <v-col cols="12" sm="12">
          <Footer />
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import NavbarUser from '@/components/NavbarUser'
import Footer from '../../components/Footer'
// import { VueperSlides, VueperSlide } from 'vueperslides'
export default {
  components: {
    NavbarUser,
    // VueperSlides,
    // VueperSlide,
    Footer
  },
  data: () => ({
    breadcrumbs: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'home'
      }
    ],
    slides: [
      {
        title: '<p style="font-size: 2em;color: #000">บทที่1</p>',
        src: require('../../assets/i3.png'),
        link: 'Lessondetail/1'
      },
      {
        title: '<p style="font-size: 2em;color: #000">บทที่2</p>',
        src: require('../../assets/i4.png'),
        link: 'Lessondetail/2'
      },
      {
        title: '<p style="font-size: 2em;color: #000">บทที่3</p>',
        src: require('../../assets/i2.png'),
        link: 'Lessondetail/3'
      },
      {
        title: '<p style="font-size: 2em;color: #000">บทที่4</p>',
        src: require('../../assets/i1.png'),
        link: 'Lessondetail/4'
      },
      {
        title: '<p style="font-size: 2em;color: #000">บทที่5</p>',
        src: require('../../assets/i1.png'),
        link: 'Lessondetail/5'
      }
    ],
    alllesson: []
  }),
  created () {
    this.getLesson()
  },
  methods: {
    async getLesson () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/lessonHome.php').then((res) => {
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
@import url("https://fonts.googleapis.com/css2?family=Prompt&display=swap");
* {
  font-family: "Prompt", sans-serif;
}
.v-breadcrumbs >>> a {
  color: #fcad74;
}
.text {
  margin-top: 10%;
}
.vueperslide >>> image {
  transform: scale(1.5) rotate(-10deg) !important;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.3);
}

/* .vueper-slide >>> link {
  color: #fcad74;
} */
.vueper-slide >>> link {
  color: black !important;
}
a {
  text-decoration: none;
}
</style>
