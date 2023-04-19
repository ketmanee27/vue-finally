<template>
  <div>
    <NavbarAdmin />
    <div>
      <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
    </div>
    <v-card class="cardShowuser mt-0">

        <!-- <v-card-title>
          <v-icon class="mr-2" color="#fcad74">mdi-video</v-icon>รายละเอียดวิดีโอ
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

        </v-card-title>-->
        <v-card-title>บทที่ {{ lesson_id}}
          <v-spacer></v-spacer>
          <v-btn icon>
                <v-icon color="red" @click="OpenDialog()">mdi-plus</v-icon>
              </v-btn>

        </v-card-title>
        <v-divider></v-divider>
        <v-container>
          <center>
              <div class="mt-5">
                <v-row>
          <v-col cols="12" xs="12" sm="12"
                md="6" v-for="video in allvideo" v-bind:key="video.video_id">
                <v-card outlined style="border: 1px solid #fcad74;">
            <video autoplay controls class="mt-5" width="90%">
  <source :src="video.video_file" />
</video>

                <!-- <video autoplay controls :src="video.video_file">
  The “video” tag is not supported by your browser.
</video> -->
                <!-- <iframe :src="video.video_file" width="100%" height="600px"></iframe> -->

                <!-- <iframe width="100%" src="https://www.youtube.com/embed/GTcM3qCeup0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
                <v-divider class="mt-5" color="#fcad74"></v-divider>

<v-card-actions class="ml-5 mr-5">
  {{video.video_subunit}} {{video.video_name}}
  <v-spacer></v-spacer>

              <v-btn icon>
                <v-icon color="#56a062" @click="editItem(video)">mdi-pencil</v-icon>
              </v-btn>
              <v-btn icon>
                <v-icon color="red" @click="deleteItem(video)">mdi-delete</v-icon>
              </v-btn>
</v-card-actions>
              </v-card>
                </v-col>
          </v-row>
              </div>
              </center>
            </v-container>
    </v-card>
    <v-dialog v-model="dialog" max-width="600px" persistent>
                      <v-card>
          <v-card-title> แก้ไขวิดีโอ </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="บทที่"
                    required
                    v-model="lesson_id"
                    disabled
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="บทย่อยที่"
                    required
                    v-model="video_subunit"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ชื่อวิดีโอ"
                    v-model="video_name"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="saveUpdate()"> บันทึก </v-btn>
          </v-card-actions>
        </v-card>
                </v-dialog>
                <v-dialog v-model="dialog1" max-width="600px" persistent>
             <v-card>
          <v-card-title> เพิ่มวิดีโอ </v-card-title>
          <v-card-text>
            <v-container>
              <v-form v-model="valid1" ref="form1" enctype='multipart/form-data'>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="บทที่"
                    required
                    v-model="lesson_id"
                    disabled
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="บทย่อยที่"
                    required
                    v-model="video.video_subunit"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ชื่อวิดีโอ"
                    v-model="video.video_name"
                    required
                  ></v-text-field>
                </v-col>
                <v-col>
                  <v-file-input
        required
    label="ไฟล์วิดีโอ"
    v-model="video.video_file"
  ></v-file-input>
                </v-col>
              </v-row>
              </v-form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog1 = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="insertVideo()"> บันทึก </v-btn>
          </v-card-actions>
        </v-card>
                </v-dialog>

  </div>
</template>
<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'
export default {
  components: {
    NavbarAdmin
  },
  data: () => ({
    dialog: false,
    dialog1: false,
    reveal: false,
    alllesson: [],
    allvideo: [],
    lesson_id: localStorage.getItem('vdo_lesson_id'),
    video_id: '',
    video_subunit: '',
    video_name: '',
    video: {
      lesson_id: '',
      video_subunit: '',
      video_name: '',
      video_file: ''
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
        text: 'จัดการวิดีโอ',
        disabled: false,
        href: 'adminvideo'
      },
      {
        text: 'วิดีโอ',
        disabled: true,
        href: 'adminvideo'
      }
    ]
  }),
  created () {
    this.getLesson()
    this.getVideo()
  },
  methods: {
    async getVideo () {
      var url =
        'http://localhost/vue-backend/video.php?lesson_id=' + this.lesson_id
      // alert(url)
      // alert('vdo')
      axios.get(url).then(res => {
        console.log('data:', res.data)
        if (res.data) {
          this.allvideo = res.data
          // alert(res1.data.video_id)
        }
      })
    },
    async getLesson () {
      axios.get('http://localhost/vue-backend/editLesson.php').then(res => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    OpenDialog () {
      this.dialog1 = true
    },
    insertVideo () {
      if (this.$refs.form1.validate()) {
        const formData = new FormData()
        formData.append('video_subunit', this.video.video_subunit)
        formData.append('video_name', this.video.video_name)
        formData.append('video_file', this.video.video_file)
        formData.append('lesson_id', this.lesson_id)
        //   alert(this.file)
        var headers = {
          'Content-Type': 'application/json',
          'Access-Control-Allow-Origin': '*'
        }

        var { data } = axios
          .post(
            'http://localhost/vue-backend/insertVideo.php',
            formData,
            headers
          )
          .then(function (response) {
            // handle success
            console.log(response)
            console.log('success')
            if (data === 'success') {
              Swal.fire({
                icon: 'success',
                title: 'โพสต์สำเร็จ',
                showConfirmButton: false,
                // text: 'คำอธิบาย',
                customClass: {
                  title: 'csss'
                },
                timer: 1500
              })
            }
          })
          .catch(function (response) {
            // handle error
            console.log(response)
            console.log('sorry')
          })
      }
      this.dialog = false
      this.$refs.form1.reset()
      this.getVideo()
    },
    // async insertVideo () {
    //   if (this.$refs.form1.validate()) { // กรอกครบมั้ย
    //     var { data } = await axios.post('http://localhost/vue-backend/insertVideo.php', {
    //       // post_id: this.post_id,
    //       lesson_id: this.lesson_id,
    //       video_subunit: this.video.video_subunit,
    //       video_name: this.video.video_name
    //     })
    //     if (data === 'success') {
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'เพิ่มสำเร็จ',
    //         showConfirmButton: false,
    //         // text: 'คำอธิบาย',
    //         customClass: {
    //           title: 'csss'
    //         },
    //         timer: 1500
    //       })
    //     }
    //     this.dialog1 = false
    //     this.getWebsite()
    //   }
    // },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.lesson_id = data.lesson_id
      this.video_subunit = data.video_subunit
      this.video_name = data.video_name
      // this.create_at = data.create_at
    },
    async saveUpdate () {
      var bodyValue = {
        lesson_id: this.lesson_id,
        video_subunit: this.video_subunit,
        video_name: this.video_name
        // create_at: this.create_at

      }
      var { data } = await axios.put('http://localhost/vue-backend/updateVideo.php', bodyValue)
      console.log(data, 'data here!')
      if (data === 'success') {
        this.dialog = false
        Swal.fire({
          icon: 'success',
          title: 'แก้ไขสำเร็จ',
          showConfirmButton: false,
          // text: 'คำอธิบาย',
          customClass: {
            title: 'csss'
          },
          timer: 1500
        })
        this.dialog = false
        this.getVideo()
      // setTimeout(() => {
      //   this.getData()
      // }, 2000)
      }
    },
    async deleteItem (data) {
      var { data: deletes } = await axios.post(
        'http://localhost/vue-backend/deleteVideo.php',
        {
          video_subunit: data.video_subunit
        }
      )
      console.log(deletes, 'delete')
      if (deletes === 'success') {
        this.dialog = false
        Swal.fire({
          icon: 'success',
          title: 'ลบสำเร็จ',
          showConfirmButton: false,
          // text: 'คำอธิบาย',
          customClass: {
            title: 'csss'
          },
          timer: 1500
        })
        setTimeout(() => {
          this.getVideo()
        }, 1500)
      }
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

/* .v-card {
  transition: opacity 0.5s ease-in-out rgb(255, 255, 107);
  box-shadow: 1px 1px 9px 9px lightblue;
} */

.show-btns {
  color: #feedb0 !important;
  box-shadow: 10px 10px 5px 12px lightblue;
}
.v-breadcrumbs >>> a {
  color: #fcad74;
}
</style>
