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
                <p style="font-size: 30px; color: #F49300;">
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
              <v-card-text >
                  <p style="font-size: 30px; color: #F49300;">
                    ความรู้เบื้องต้น การเลี้ยงไก่
                </p>
                <hr />
                <div class="text--primary mt-10 text-justify" margin-top="15px">
                  ไก่พื้นเมือง เป็นสัตว์ปีกท้องถิ่นที่มีลักษณะเด่น คือ เลี้ยงง่าย
                  มีความสามารถในการปรับ ตัวเข้ากับสภาพแวดล้อมได้ดี
                  มีความทนต่อโรคระบาดที่สำคัญในสัตว์ปีกได้ดี หากินเก่ง ใช้อาหารคุณภาพต่ำได้ดี
                  รวมถึงมีความต้านทานความเครียดเนื่องจากความร้อน (heat stress)
                  ได้ดีกว่าสายพันธุ์ที่นำเข้าจากต่างประเทศ (เกรียงไกร และคณะ,
                  2543) จึงทำให้ เกษตรกรจำนวนมากนิยมเลี้ยงไก่พื้นเมืองเพิ่มมากขึ้น
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
      <v-toolbar-title>เนื้อหาการเรียนรู้  </v-toolbar-title>
        <v-spacer></v-spacer>
      <a href="/lesson"><span class="black--text">ดูทั้งหมด</span></a>
      <p v-for="slide of slides" :key="slide.slider_id">
      {{ slides.slider_id }}
    </p>
    </v-toolbar>
   <div class="px-7">
    <v-hover
          v-slot="{ hover }"
          open-delay="200"
        >
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
    :image="slider_src"
    :title="slider_title"
    :link="slider_link"
    :style="'background-color: ' + ['#099fae', '#F49300'][i % 2] "/>
  </vueper-slides>
    </v-hover>
  </div>
  <v-row class="footer" style="margin-top:5%">
    <v-col cols="12" sm="12">
                <Footer />
  </v-col>
  </v-row>
  </div>
  </div>
  </template>
<script>
import axios from 'axios'
export default {
  name: 'App',
  data () {
    return {
      items: []
    }
  },
  async created () {
    try {
      const res = await axios.get('http://localhost/vue-backend/slider.php')
      this.slide = res.data
      // alert(this.slide)
    } catch (error) {
      console.log(error)
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
  .vueper-slide >>> link{
    color: black !important;
  }
  a{
    text-decoration: none;
  }
  </style>
