<template>
  <div>
    <NavbarAdmin />
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
          <td>{{ lesson_id }}</td>
          <td>{{ lesson_name }}</td>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small  @click="openVideo(item.lesson_id)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <!-- <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item)" color="#ea5859">
            mdi-delete
          </v-icon>
        </template> -->
        <!-- <template v-slot:expanded-item="{ headers, item }">
          <td :colspan="headers.length" class="elevation-0 grey lighten-4">
            0.0 {{item.lesson_name}}
          </td>
        </template> -->
      </v-data-table>
      <v-dialog v-model="dialog" max-width="900px" persistent>
        <v-card>
          <v-card-title> วิดีโอ </v-card-title>
          <v-card-text>
            <v-container>
              <v-btn
                  block
                  color="primary"
                  class="mb-3"
                  @click="openinsert()"
                >
                  เพิ่มวิดีโอ
                </v-btn>
              <v-row>
                <!-- <v-form v-model="valid" ref="form"> -->
                  <v-col cols="12" sm="4" v-for="video in allvideo" v-bind:key="video.video_id">
                    <v-card class="pa-3">
                      <div >
                      <iframe :src="video.video_file" width="100%"></iframe>

                      <!-- <iframe width="100%" src="https://www.youtube.com/embed/GTcM3qCeup0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

                      <div class="mt-2 mb-2">{{video.video_subunit}} {{video.video_name}}</div>
                      <v-row >
                        <v-col align="center">
                          <v-btn
                            icon
                          >
                            <v-icon small color="#56a062" @click="editVideo(item)">mdi-pencil</v-icon>
                          </v-btn>
                        </v-col>
                        <v-col align="center">
                          <v-btn
                            icon
                          >
                          <v-icon small @click="dialog= false" color="#ea5859">mdi-delete</v-icon>
                          </v-btn>
                          <v-btn
                            icon
                          >
                          </v-btn>
                        </v-col>
                      </v-row>
                    </div>
                    </v-card>
                  </v-col>
                <!-- </v-form> -->
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="openVideo(item.lesson_id)">
              ปิด
            </v-btn>
            <!-- <v-btn color="blue darken-1" text @click="saveUpdate()">
              บันทึก
            </v-btn> -->
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card>
    <v-row justify="center">
    <v-dialog
      v-model="dialog1"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          เพิ่มวิดีโอ
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form v-model="valid1" ref="form1" >
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="บทที่"
                  v-model="lesson_id"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="บทย่อยที่"
                  type="text"
                  v-model="video_subunit"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
              <v-text-field
                  label="ชื่อวิดีโอ"
                  type="text"
                  v-model="video_name"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
              <v-file-input
                small-chips
                multiple
                label="ไฟล์วิดีโอ"
                required
                v-model="file"
                v-on:change="onChangeFileUpload()"
              ></v-file-input>

              <!-- <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()" @input="pickFile" > -->

            </v-col>
            </v-row>
          </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog1 = false"
          >
            ปิด
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            v-on:click="insertVideo()"
          >
            บันทึก
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="dialog2"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-card-title>
          แก้ไขวิดีโอ
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-form v-model="valid2" ref="form2" >
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="บทที่"
                  v-model="lesson_id"
                  required
                  disabled
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="บทย่อยที่"
                  type="text"
                  v-model="video_subunit"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
              <v-text-field
                  label="ชื่อวิดีโอ"
                  type="text"
                  v-model="video_name"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
              >
              <!-- <v-file-input
              ref="file"
                small-chips
                multiple
                label="ไฟล์วิดีโอ"
                required
                v-model="file"
                v-on:change="onChangeFileUpload()"
              ></v-file-input> -->

              <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()" @input="pickFile" >

            </v-col>
            </v-row>
          </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog2 = false"
          >
            ปิด
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            v-on:click="insertVideo()"
          >
            บันทึก
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </v-row>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'

import dedent from 'dedent'

// import theme style

export default {
  components: {
    NavbarAdmin
  },
  data () {
    return {
      expanded: [],
      singleExpand: false,
      dialog: false,
      dialog1: false,
      dialog2: false,
      alllesson: [],
      allvideo: [],
      video_id: '',
      video_subunit: '',
      video_name: '',
      file: '',
      lesson_unit: '',
      video: {
        video_subunit: '',
        video_name: '',
        video_file: '',
        lesson_unit: ''
      },
      valid1: false,
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
        { text: 'แก้ไข', value: 'edit', sortable: false }
      ],
      data: [],
      content: dedent``,
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'admindashboard'
        },
        {
          text: 'จัดการวิดีโอ',
          disabled: true,
          href: 'adminvideo'
        }
      ]
    }
  },
  created () {
    this.getLesson()
    this.getVideo()
  },
  methods: {
    // async getVideo () {
    //   console.log('rewload')
    //   axios.get('http://localhost/vue-backend/video.php').then((res) => {
    //     console.log('data:', res.data)
    //     if (res.data) {
    //       this.allvideo = res.data
    //     }
    //   })
    // },
    async getVideo () {
      var url = 'http://localhost/vue-backend/video.php?lesson_id=' + this.lesson_id
      // alert(url)
      // alert('vdo')
      axios.get(url).then((res1) => {
        console.log('data:', res1.data)
        if (res1.data) {
          this.allvideo = res1.data
          // alert(res1.data.video_id)
        }
      })
    },

    openVideo (item) {
      localStorage.setItem('vdo_lesson_id', item)
      this.$router.push('adminVideoDetail')
    },
    async getLesson () {
      axios.get('http://localhost/vue-backend/editLesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    OpenDialog () {
      this.dialog1 = true
      this.$refs.form.reset()
      this.lesson_description = ''
    },
    openinsert () {
      this.dialog1 = true
    },
    addFormData () {
      if (this.$refs.form1.validate()) {
        const formData = new FormData()
        formData.append('video_subunit', this.video_subunit)
        formData.append('video_name', this.video_name)
        formData.append('video_file', this.video_file)
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
    insertVideo () {
      if (this.$refs.form1.validate() && this.file) {
        console.log(this.file)
        const formData = new FormData()
        // formData.append('file', this.file)
        formData.append('video_subunit', this.video_subunit)
        formData.append('video_name', this.video_name)
        formData.append('lesson_unit', this.lesson_unit)
        console.log(formData)
        // กรอกครบมั้ย
        this.axios.post(
          'http://localhost/vue-backend/insertVideo.php', formData,
          {
            // video_subunit: this.video_subunit,
            // video_name: this.video_name,
            // // // video_file: this.video_file,
            // // file: this.file,
            // lesson_unit: this.lesson_unit,
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
        )
        if (formData === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'เพิ่มสำเร็จ',
            showConfirmButton: false,
            // text: 'คำอธิบาย',
            customClass: {
              title: 'csss'
            },
            timer: 1500
          })
        }
        this.dialog1 = false
        // this.getVideo()
        // this.$refs.form.reset()
        // this.lesson_description = ''
        // this.$refs.form.reset()
        // this.postuser.post_detail = ''
      }
    },
    onChangeFileUpload () {
      this.file = this.$refs.file.files[0]
    },

    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.lesson_unit = data.lesson_unit
      this.video_subunit = data.video_subunit
      this.video_name = data.video_name
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    editVideo (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog2 = true
      this.lesson_unit = data.lesson_unit
      this.video_subunit = data.video_subunit
      this.video_name = data.video_name
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate () {
      var bodyValue = {
        video_id: this.video_id,
        video_subunit: this.video_subunit,
        video_name: this.video_name,
        lesson_id: this.lesson_id
      }
      var { data } = await axios.put(
        'http://localhost/vue-backend/updateLesson.php',
        bodyValue
      )
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
        this.getLesson()
        // setTimeout(() => {
        //   this.getData()
        // }, 2000)
      }
    },
    // closedialog () {
    //   this.dialog = false
    // }
    async deleteItem (data) {
      // var idDel = parseInt(data.id)
      var { data: deletes } = await axios.post(
        'http://localhost/vue-backend/deleteLesson.php',
        {
          lesson_id: data.lesson_id
        }
      )
      console.log(deletes, 'delete')
      if (deletes === 'success') {
        // this.dialog = false
        // Swal.fire({
        //   icon: 'success',
        //   title: 'ลบสำเร็จ',
        //   showConfirmButton: false,
        //   text: 'คำอธิบาย',
        //   customClass: {
        //     title: 'csss'
        //   },
        //   timer: 1500
        // })
        Swal.fire({
          title: 'คุณต้องการลบบทเรียน?',
          // text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Delete'
        }).then((result) => {
          if (result.isConfirmed) {
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
          }
        })
        this.getLesson()
      }
    }
  }
  // mounted () {
  //   this.getUser()
  // }
}
</script>

<style scoped>
* {
  font-family: "Prompt", sans-serif;
}
.cardShowuser {
  margin-top: 5%;
}
.head {
  background-color: red;
}
.example {
  display: flex;
  flex-direction: column;
}
.editor {
  width: 100%;
  height: 30rem;
  overflow: hidden;
  border-bottom: 0.5px solid #d2d2d2;
}

.output {
  width: 100%;
  height: 20rem;
  margin: 0;
  border: 1px solid #ccc;
  overflow-y: auto;
  resize: vertical;
}
.code {
  padding: 1rem;
  height: 16rem;
}

.ql-snow {
  border-top: none;
  height: 24rem;
}
.v-data-table__expanded .v-data-table__expanded__content td {
  box-shadow: 0px;
}
.v-breadcrumbs >>> a {
    color: #fcad74 ;
}
</style>
