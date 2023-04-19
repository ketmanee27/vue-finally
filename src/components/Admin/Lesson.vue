<template>
  <div>
    <NavbarAdmin />
    <div>
      <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
    </div>
    <v-card class="cardShowuser mt-0">
      <v-card-title>
        <v-icon class="mr-2" color="#fcad74">mdi-book-open-variant</v-icon>
        บทเรียน
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
        <v-btn
          class="mx-2"
          fab
          dark
          small
          color="#099fae"
          @click="OpenDialog()"
        >
          <v-icon dark> mdi-plus </v-icon>
        </v-btn>
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
          <td>{{ lesson_nameimg }}</td>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small @click="editItem(item)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item)" color="#ea5859">
            mdi-delete
          </v-icon>
        </template>
        <!-- <template v-slot:expanded-item="{ headers, item }">
      <td :colspan="headers.length" class="elevation-0 grey lighten-4">
        0.0 {{item.lesson_name}}
      </td>
    </template> -->
      </v-data-table>
      <v-dialog v-model="dialog1" max-width="1250px" persistent>
        <v-card>
          <v-card-title> เพิ่มบทเรียน </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-form v-model="valid1" ref="form1">
                  <v-col cols="12">
                    <v-text-field
                      label="บทที่"
                      required
                      v-model="lesson.lesson_id"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="บทเรียนเรื่อง"
                      required
                      v-model="lesson.lesson_name"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input
                    accept="image/*"
                    v-model="lesson.lesson_unitimg"
                    required
                    label="รูปภาพหน้าปกบทเรียน"
                    variant="underlined"></v-file-input>
                  </v-col>
                  <!-- <v-col cols="12">
                            <v-text-field
                              label="เนื้อหาบทเรียน"
                              v-model="lesson_description"
                              required
                            ></v-text-field>
                          </v-col> -->
                  <v-col cols="12">
                    <div class="example">
                      <quill-editor
                        class="editor"
                        ref="myTextEditor"
                        :value="content"
                        :options="editorOption"
                        @change="onEditorChange"
                        @blur="onEditorBlur($event)"
                        @focus="onEditorFocus($event)"
                        @ready="onEditorReady($event)"
                        v-model="lesson.lesson_description"
                      />
                      <!-- <div class="output code">
                                  <code class="hljs" v-html="contentCode"></code>
                                </div>
                                <div class="output ql-snow">
                                  <div class="ql-editor" v-html="content"></div>
                                </div> -->
                    </div>
                  </v-col>
                </v-form>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog1 = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="insertLesson()">
              บันทึก
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <v-dialog v-model="dialog" max-width="1250px" persistent>
        <v-card>
          <v-card-title> แก้ไขบทเรียน </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-form v-model="valid" ref="form">
                  <v-col cols="12">
                    <v-text-field
                      label="บทที่"
                      required
                      v-model="lesson_id"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="บทเรียนเรื่อง"
                      required
                      v-model="lesson_name"
                    ></v-text-field>
                  </v-col>
                  <!-- <v-col cols="12">
                    <v-text-field
                      label="บทเรียนเรื่อง"
                      required
                      v-model="lesson_nameimg"
                    ></v-text-field>
                  </v-col> -->
                  <!-- <v-col cols="12">
                    <v-file-input
                    accept="image/*"
                    v-model="lesson_unitimg"
                    required
                    label="รูปภาพหน้าปกบทเรียน"
                    ></v-file-input>
                  </v-col> -->
                  <!-- <v-col cols="12">
                            <v-text-field
                              label="เนื้อหาบทเรียน"
                              v-model="lesson_description"
                              required
                            ></v-text-field>
                          </v-col> -->
                  <v-col cols="12">
                    <div class="example">
                      <quill-editor
                        class="editor"
                        ref="myTextEditor"
                        :value="content"
                        :options="editorOption"
                        @change="onEditorChange"
                        @blur="onEditorBlur($event)"
                        @focus="onEditorFocus($event)"
                        @ready="onEditorReady($event)"
                        v-model="lesson_description"
                      />
                      <!-- <div class="output code">
                                  <code class="hljs" v-html="contentCode"></code>
                                </div>
                                <div class="output ql-snow">
                                  <div class="ql-editor" v-html="content"></div>
                                </div> -->
                    </div>
                  </v-col>
                </v-form>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="saveUpdate()">
              บันทึก
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'

import dedent from 'dedent'
import hljs from 'highlight.js'
import debounce from 'lodash/debounce'
import { quillEditor } from 'vue-quill-editor'

// highlight.js style
import 'highlight.js/styles/tomorrow.css'

// import theme style
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'

export default {
  name: 'quill-example-snow',
  title: 'Theme: snow',
  components: {
    NavbarAdmin,
    quillEditor
  },
  data () {
    return {
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'home'
        },
        {
          text: 'จัดการบทเรียน',
          disabled: true,
          href: 'adminlesson'
        }
      ],
      items: [
        {
          id: 1,
          name: 'Applications :',
          children: [
            { id: 2, name: 'Calendar : app' },
            { id: 3, name: 'Chrome : app' },
            { id: 4, name: 'Webstorm : app' }
          ]
        },
        {
          id: 5,
          name: 'Documents :',
          children: [
            {
              id: 6,
              name: 'vuetify :',
              children: [
                {
                  id: 7,
                  name: 'src :',
                  children: [
                    { id: 8, name: 'index : ts' },
                    { id: 9, name: 'bootstrap : ts' }
                  ]
                }
              ]
            }
          ]
        }
      ],
      expanded: [],
      singleExpand: false,
      dialog: false,
      dialog1: false,
      alllesson: [],
      lesson_id: '',
      lesson_name: '',
      lesson_description: '',
      lesson: {
        lesson_id: '',
        lesson_name: '',
        lesson_unitimg: '',
        lesson_description: ''
      },
      valid: false,
      valid1: false,
      search: '',
      headers: [
        {
          text: 'บทที่',
          align: 'start',
          value: 'lesson_id'
        },
        { text: 'บทเรียนเรื่อง', value: 'lesson_name' },
        // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
        { text: 'แก้ไข', value: 'edit', sortable: false },
        { text: 'ลบ', value: 'delete', sortable: false }
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
            highlight: (text) => hljs.highlightAuto(text).value
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
    async insertLesson () {
      const formData = new FormData()
      formData.append('lesson_id', this.lesson.lesson_id)
      formData.append('lesson_name', this.lesson.lesson_name)
      formData.append('lesson_unitimg', this.lesson.lesson_unitimg)
      formData.append('lesson_description', this.lesson.lesson_description)
      //   alert(this.file)
      var headers = {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*'
      }
      axios.post('http://localhost/vue-backend/insertLesson.php', formData, headers)
        .then(function (response) {
          // handle success
          // this.dialog1 = false
          // this.$refs.form1.reset()
          // this.getLesson()
          console.log(response)
          console.log('success')
          // Swal.fire({
          //   icon: 'success',
          //   title: 'เพิ่มสำเร็จ',
          //   showConfirmButton: false,
          //   // text: 'คำอธิบาย',
          //   customClass: {
          //     title: 'csss'
          //   },
          //   timer: 1500
          // })
          // this.dialog1 = false
          // this.$refs.form1.reset()
          // this.lesoon.lesson_description = ''
          // this.getLesson()
        })
        .catch(function (response) {
          // handle error
          console.log(response)
          console.log('sorry')
          this.getLesson()
        })
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
      this.getLesson()
      this.dialog1 = false
      this.$refs.form1.reset()
      this.lesson.lesson_description = ''
    },
    // async saveInsert () {
    //   var bodyValue = {
    //     lesson_id: this.lesson_id,
    //     lesson_name: this.lesson_name,
    //     lesson_description: this.lesson_description
    //   }
    //   var { data } = await axios.put('http://localhost/vue-backend/updateLesson.php', bodyValue)
    //   console.log(data, 'data here!')
    //   if (data === 'success') {
    //     this.dialog = false
    //     Swal.fire({
    //       icon: 'success',
    //       title: 'แก้ไขสำเร็จ',
    //       showConfirmButton: false,
    //       text: 'คำอธิบาย',
    //       customClass: {
    //         title: 'csss'
    //       },
    //       timer: 1500
    //     })
    //     this.getLesson()
    //     // setTimeout(() => {
    //     //   this.getData()
    //     // }, 2000)
    //   }
    // },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.lesson_id = data.lesson_id
      // this.lesson_nameimg = data.lesson_nameimg
      this.lesson_name = data.lesson_name
      this.lesson_description = data.lesson_description
      this.create_at = data.create_at
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate () {
      var bodyValue = {
        lesson_id: this.lesson_id,
        lesson_name: this.lesson_name,
        lesson_description: this.lesson_description,
        create_at: this.create_at
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
        this.dialog = false
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
        // Swal.fire({
        //   title: 'คุณต้องการลบบทเรียน?',
        //   // text: "You won't be able to revert this!",
        //   icon: 'warning',
        //   showCancelButton: true,
        //   confirmButtonColor: '#3085d6',
        //   cancelButtonColor: '#d33',
        //   confirmButtonText: 'Delete'
        // }).then((result) => {
        //   if (result.isConfirmed) {
        //     Swal.fire({
        //       icon: 'success',
        //       title: 'ลบสำเร็จ',
        //       showConfirmButton: false,
        //       // text: 'คำอธิบาย',
        //       customClass: {
        //         title: 'csss'
        //       },
        //       timer: 1500
        //     })
        //   }
        // })
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
  box-shadow: 0px 0px 0px 0px;
}
.v-breadcrumbs >>> a {
  color: #fcad74;
}
</style>
