<template>
  <div>
    <NavbarUser />
    <div>
    <v-breadcrumbs
      :items="breadcrumbs"
      large
    ></v-breadcrumbs>
  </div>
  <v-card class="cardShowuser mt-0">
      <v-card-title>
        <v-icon class="mr-2" color="#fcad74">mdi-video</v-icon>
        วิดีโอ
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="ค้นหา"
          dense
          color="#099fae"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <!-- <v-card-title>friend</v-card-title> -->
      <v-data-table
      :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alllesson"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        :single-expand="singleExpand"
        :expanded.sync="expanded"
        item-key="name"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
      >
        <template slot="data">
          <td>{{ lesson_id}}</td>
          <td>{{ lesson_name }}</td>
        </template>

        <template v-slot:item.edit="{ item }">
          <v-icon small @click="openVideo(item.lesson_id)" color="#56a062">
            mdi-video
          </v-icon>
        </template>

      </v-data-table>
      <v-dialog v-model="dialog" max-width="900px" persistent>
        <v-card>
          <v-card-title> วิดีโอ </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <!-- <v-form v-model="valid" ref="form"> -->
                  <v-col cols="12" sm="4" v-for="video in allvideo" v-bind:key="video.video_id">
                    <v-card class="pa-3">
                      <div >
                      <iframe :src="video.video_file" width="100%"></iframe>

                      <!-- <iframe width="100%" src="https://www.youtube.com/embed/GTcM3qCeup0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                      <div class="mt-2 mb-2">{{video.video_subunit}}
                        <router-link v-bind:to="'/videodetail/'">{{video.video_name}}</router-link></div>
                    </div>
                    </v-card>
                  </v-col>
                <!-- </v-form> -->
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              ปิด
            </v-btn>
            <!-- <v-btn color="blue darken-1" text @click="saveUpdate()">
              บันทึก
            </v-btn> -->
          </v-card-actions>
        </v-card>
      </v-dialog>
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
    lesson_id: '',
    lesson_unit: '',
    lesson_name: '',
    lesson_description: '',
    lesson: {
      lesson_unit: '',
      lesson_name: '',
      lesson_description: ''
    },
    headers: [
      {
        text: 'บทที่',
        align: 'start',
        value: 'lesson_id'
      },
      { text: 'บทเรียนเรื่อง', value: 'lesson_name' },
      // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
      { text: 'ดูวิดีโอ', value: 'edit', sortable: false }
    ],
    breadcrumbs: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'home'
      },
      {
        text: 'วิดีโอ',
        disabled: true,
        href: 'video'
      }
    ],
    dialog: false
  }),
  created () {
    this.getLesson()
    this.getVideo()
  },
  methods: {
    async getVideo () {
      var url = 'http://localhost/vue-backend/video.php?lesson_id=10'
      // alert(url)
      axios.get(url).then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allvideo = res.data
        }
      })
    },
    async getLesson () {
      axios.get('http://localhost/vue-backend/editLesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    openVideo (item) {
      // this.dialog = true
      // this.dialog = true
      // alert(item)
      // var url2 = '/vue-backend/video.php?lesson_id='
      // alert(url2)
      // this.$router.push('videoDetail/')
      // this.$router.push(url2)
      // this.getVideo(1)
      // alert(item)
      // this.dialog = true
      localStorage.setItem('vdo_lession_id', item)
      this.$router.push('videoDetail')
      // window.location.href = 'videoDetail/' + ===
    },
    deleteItem (item) {
      this.dialog = false
    }

  }
  // mounted () {
  //   this.$emit('test', true)
  // }
}
</script>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Prompt&display=swap");
* {
  font-family: "Prompt", sans-serif;
}

.text-h4 {
  text-align: center;
  font-size: 20px;
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
  text-align: center;
}
.text-title {
  text-align: center;
  padding: 15px;
  font-size: 1.3em !important;
  color: rgb(75, 75, 75);
}
a {
  text-decoration: none;
  text-align: center;
  color: #56a062;
}
.lesson {
  text-align: center;
  margin-top: 30px;
}

.v-card {
  transition: opacity 0.5s ease-in-out rgb(255, 255, 107);
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
