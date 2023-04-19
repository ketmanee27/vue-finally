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
      <v-icon class="mr-2" color="#fcad74">mdi-book-open-variant</v-icon>
     ประวัติเรียนและสอบ
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
    <v-card-title>
      <v-spacer></v-spacer>
    </v-card-title>
    <!-- <v-card-title>friend</v-card-title> -->
       <v-data-table :items="alllesson" :headers="headers" :items-per-page="5" :search="search"
       :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}">
       <template slot="data">
        <td>{{lesson_id}}</td>
        <td>{{lesson_name}}</td>
      </template>
          <template v-slot:item.time="{ item }">
      <td @click="time(item)">19.19</td>
    </template>
    <template v-slot:item.date="{ item }">
      <td @click="date(item)">09/06/2565</td>
    </template>

      <template v-slot:item.pretest="{ item }">
      <v-icon
        small
        @click="preTest(item)"
        color="#56a062"
      >
        mdi-checkbox-marked-circle
      </v-icon>
    </template>
    <template v-slot:item.posttest="{ item }">
      <v-icon
        small
        @click="postTest(item)"
        color="#56a062"
      >
        mdi-checkbox-marked-circle
      </v-icon>
    </template>
    </v-data-table>
    <v-dialog v-model="dialog" max-width="600px">
                  <v-card>
                    <v-card-title align="center">
                      <v-row align="center" justify="center" class="ma-5">คะเเนนการทำข้อสอบ pretest</v-row>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-row align="center" justify="center">
                          <h2 color="#fcad74">25</h2> <h2>/50</h2>
                       </v-row>
                       <v-row align="center" justify="center">
                          <v-btn
                            text
                            color="#fcad74"
                            class="ma-5"
                          >
                            ดูประวัติการทำข้อสอบ
                          </v-btn>
                          <v-btn color="blue darken-1" text @click="dialog = false">
                        ปิด
                      </v-btn>
                       </v-row>
                      </v-container>
                    </v-card-text>
                  </v-card>
                </v-dialog>
                    <v-dialog v-model="dialog1" max-width="600px">
                  <v-card>
                    <v-card-title align="center">
                      <v-row align="center" justify="center" class="ma-5">คะเเนนการทำข้อสอบ posttest</v-row>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-row align="center" justify="center">
                          <h2 color="#fcad74">39</h2> <h2>/50</h2>
                       </v-row>
                       <v-row align="center" justify="center">
                          <v-btn
                            text
                            color="#fcad74"
                            class="ma-5"
                          >
                            ดูประวัติการทำข้อสอบ
                          </v-btn>
                          <v-btn color="blue darken-1" text @click="dialog1 = false">
                        ปิด
                      </v-btn>
                       </v-row>
                      </v-container>
                    </v-card-text>
                  </v-card>
                </v-dialog>

  </v-card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarUser from '@/components/NavbarUser'

import dedent from 'dedent'
import hljs from 'highlight.js'
import debounce from 'lodash/debounce'

// highlight.js style
import 'highlight.js/styles/tomorrow.css'

// import theme style
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'

export default {
  name: 'quill-example-snow',
  title: 'Theme: snow',
  components: {
    NavbarUser
  },
  data () {
    return {
      dialog: false,
      dialog1: false,
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
      valid: false,
      search: '',
      headers: [
        {
          text: 'บทที่',
          align: 'start',
          value: 'lesson_id'
        },
        { text: 'บทเรียนเรื่อง', value: 'lesson_name' },
        // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
        { text: 'เวลาที่สอบ', value: 'time', sortable: false },
        { text: 'วันที่ทำข้อสอบ', value: 'date', sortable: false },
        { text: 'pretest', value: 'pretest', sortable: false },
        { text: 'posttest', value: 'posttest', sortable: false }

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
      content: dedent``,
      breadcrumbs: [
        {
          text: 'หน้าแรก',
          disabled: false,
          href: 'home'
        },
        {
          text: 'ประวัติเข้าเรียนและสอบ',
          disabled: true,
          href: 'history'
        }
      ]
    }
  },
  created () {
    this.getLesson()
  },
  methods: {
    async getLesson () {
      axios.get('http://localhost/vue-backend/editLesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    async insertItem (lesson) {
      // console.log(this.$refs.form.validate(), 'pp')
      if (this.$refs.form.validate()) { // กรอกครบมั้ย
        var { data } = await axios.post('http://localhost/vue-backend/insertLesson.php', {
          lesson_unit: this.lesson_unit,
          lesson_name: this.lesson_name,
          lesson_description: this.lesson_description
        })
        if (data === 'success') {
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
        this.getLesson()
        // this.postuser.post_detail = ''
        this.$refs.form.reset()
      }
    },
    preTest (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
    },
    postTest (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog1 = true
    },
    async save () {
      var bodyValue = {
        lesson_id: this.lesson_id,
        lesson_unit: this.lesson_unit,
        lesson_name: this.lesson_name,
        lesson_description: this.lesson_description
      }
      var { data } = await axios.put('http://localhost/vue-backend/updateLesson.php', bodyValue)
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
      var { data: deletes } = await axios.post('http://localhost/vue-backend/deleteLesson.php', {
        lesson_id: data.lesson_id
      })
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
        this.getLesson()
      }
    },
    onEditorChange: debounce(function (value) {
      this.content = value.html
    }, 466),
    onEditorBlur (editor) {
      console.log('editor blur!', editor)
    },
    onEditorFocus (editor) {
      console.log('editor focus!', editor)
    },
    onEditorReady (editor) {
      console.log('editor ready!', editor)
    }
  },
  computed: {
    editor () {
      return this.$refs.myTextEditor.quill
    },
    contentCode () {
      return hljs.highlightAuto(this.content).value
    }
  },
  mounted () {
    console.log('this is Quill instance:', this.editor)
  }
  // mounted () {
  //   this.getUser()
  // }
}
</script>

<style scoped>
*{
font-family: 'Prompt', sans-serif;
}
.cardShowuser{
  margin-top: 5%;
}
.head{
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
      .v-breadcrumbs >>> a {
    color: #fcad74;
}
</style>
