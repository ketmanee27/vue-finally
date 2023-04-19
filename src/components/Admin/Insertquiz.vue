<template>
  <div>
    <NavbarAdmin />
    <div>
      <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
    </div>
    <!-- {{ item.lesson_id }} -->

    <div class="row" align="center" justify="center">
      <div class="col-md-12">
        <div class="title">
          <div v-for="(question, index) in test" :key="index">
            <h2>{{ question.question_detail }}</h2>
            <div v-for="(answer, index) in question.answer" :key="index">
              <!-- <h2>{{ answer.answer_detail }}</h2> -->
            </div>
          </div>
          <br />

          <h1 class="mt-0 mb-7" align="center">
            <span class="teal--text"> บทที่ {{ item.lesson_id }}</span>
            {{ item.lesson_name }}
          </h1>

          <!-- <h2>บทที่ {{ item.lesson_unit }} {{ item.lesson_name }}</h2> -->
        </div>
      </div>
    </div>
    <div>
      <v-btn @click="OpenDialog()" class="ma-5 ml-0" color="#fcad74" dark
        >เพิ่มคำถาม</v-btn
      >
      <!-- <v-btn @click="insertQuestion()">บันทึก</v-btn> -->
    </div>
    <v-card
      class="mx-auto mb-5"
      v-for="question in allquestion"
      :key="question.question_id"
    >
      <v-card-title
        >{{ question.question_detail }} <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="editItem(question)">
          แก้ไข
        </v-btn></v-card-title
      >
      <v-card-subtitle>
        <div v-for="answer in allanswer" v-bind:key="answer.answer_id">
          <div v-if="answer.question_id === question.question_id">
            <v-card-title
              v-if="question.question_type === 'เลือกได้หลายคำตอบ'"
              class="pa-0"
              ><v-checkbox
                :label="answer.answer_detail"
                v-model="answer.answer_status"
                true-value="Y"
                false-value="N"
              ></v-checkbox>
            </v-card-title>
            <v-card-title
              v-if="question.question_type === 'เลือกได้คำตอบเดียว'"
              class="pa-0"
            >
              <v-radio-group row>
                <v-radio
                  color="orange"
                  v-model="answer.answer_status"
                  :label="answer.answer_detail"
                  true-value="Y"
                  false-value="N"
                ></v-radio>
              </v-radio-group>
            </v-card-title>
          </div>
        </div>
      </v-card-subtitle>
    </v-card>
    <!-- {{ data.lesson_unit}}
    {{ this.$route.params.id }}
    {{ data.lesson_unit }}
    {{ allanswer }} -->
    <!-- <pre>{{ allquestion }} </pre> -->
    <!-- <v-card class="mt-4" v-for="(question, index) in allquestion" :key="index">
      <v-card-title>
        <v-icon class="mr-2" color="#fcad74">mdi-comment-question</v-icon>
        <v-form v-model="valid" ref="form">
          <v-text-field v-model="question.question_detail" :label="`คำถาม ${index + 1}`"></v-text-field>
          {{ question.answer_detail }}
        </v-form>
        <v-spacer></v-spacer>
        <v-select :items="items" label="รูปแบบการทำ" dense solo v-model="selected"></v-select>
      </v-card-title>
      <div v-for="(item, idx) in question.answer" :key="idx">
        <v-row align="center">
          <v-checkbox v-model="item.answer_status" true-value="Y" false-value="N" hide-details class="shrink ml-3 mt-0">
          </v-checkbox>
          <v-text-field :label="`คำตอบ ${idx + 1}`" class="mr-3" v-model="item.answer_detail">
          </v-text-field>
        </v-row>
      </div>
      <div class="d-flex justify-end mb-2">
        <v-btn @click="addAnswerOnClick(index)">เพิ่มคำตอบ</v-btn>
      </div>
    </v-card> -->

    <v-dialog v-model="dialog" max-width="600px" persistent>
      <v-card>
        <v-card-title> เพิ่มโจทย์ </v-card-title>
        <v-card-text>
          <v-container>
            <v-form v-model="valid" ref="form">
              <v-row>
                <v-col cols="6">
                  <!-- <div>{{ question_detail }}</div> -->
                  <v-text-field
                    prepend-icon="mdi-comment-question"
                    label="คำถาม"
                    required
                    color="#fcad74"
                    v-model="question_detail"
                  ></v-text-field>
                </v-col>
                <v-col cols="6">
                  <!-- {{ items }} -->
                  <v-select
                    required
                    :items="question_type"
                    label="รูปแบบการทำ"
                    v-model="question_type"
                    dense
                    solo
                  ></v-select>
                </v-col>
              </v-row>
              <v-card-title v-if="question_type === 'เลือกได้หลายคำตอบ'">
                <!-- {{ allanswer }} -->
                <div v-for="(answer, idx) in answerdetail" :key="idx">
                  <!-- {{ allanswer }} -->
                  <v-row>
                    <v-col cols="1">
                      <v-checkbox
                        v-model="answer.answer_status"
                        true-value="Y"
                        false-value="N"
                        color="#fcad74"
                      ></v-checkbox>
                    </v-col>
                    <v-col cols="8">
                      <v-text-field
                        label="คำตอบ"
                        color="#fcad74"
                        v-model="answer.answer_detail"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="3">
                      <!-- {{ items }} -->
                      <v-text-field
                        v-model="answer.answer_score"
                        type="number"
                        label="คะเเนน"
                        min="1"
                        dense
                        solo
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </div>
              </v-card-title>
              <v-card-title v-if="question_type === 'เลือกได้คำตอบเดียว'">
                <v-row>
                </v-row>
                <!-- {{ allanswer }} -->
                <div v-for="(answer, idx) in answerdetail" :key="idx">
                  <!-- {{ allanswer }} -->
                  <v-row>
                    <v-col cols="1">
                      <v-radio-group row>
                        <v-radio
                          color="orange"
                          v-model="answer.answer_status"
                          :label="answer.answer_detail"
                          true-value="Y"
                          false-value="N"
                        ></v-radio>
                      </v-radio-group>
                    </v-col>
                    <v-col cols="8">
                      <v-text-field
                        label="คำตอบ"
                        color="#fcad74"
                        v-model="answer.answer_detail"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="3">
                    <!-- {{ items }} -->
                    <v-text-field
                      v-model="answer.answer_score"
                      type="number"
                      label="คะเเนน"
                      min="1"
                      dense
                      solo
                    ></v-text-field>
                  </v-col>
                  </v-row>
                </div>
              </v-card-title>
              <v-row>
                <v-col cols="6">
                  <v-btn block color="primary" dark @click="addAnswer()">
                    เพิ่มคำตอบ
                  </v-btn>
                </v-col>
                <v-col cols="6">
                  <v-btn block color="red" dark @click="deleteAnswer()">
                    ลบคำตอบ
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">
            ปิด
          </v-btn>
          <v-btn color="blue darken-1" text @click="insertQuestion()">
            บันทึก
          </v-btn>
        </v-card-actions>
      </v-card>
      <!-- <v-card>
          <v-card-title> เพิ่มคำถาม</v-card-title>
          <v-card-text>
            <v-container>
              <v-form v-model="valid" ref="form">
              <v-row>
                <v-col cols="12">
                  <v-text-field
                    label="บทที่"
                    required
                    v-model="website_id"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ชื่อเว็บไซต์"
                    required
                    v-model="website_name"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ลิงก์เว็บไซต์"
                    v-model="website_link"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              </v-form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="insertWebsite()"> บันทึก </v-btn>
          </v-card-actions>
        </v-card> -->
    </v-dialog>
    <v-dialog v-model="dialogEdit" max-width="600px" persistent>
      <v-card>
        {{ answerdetail }}
        <v-card-title> แก้ไขโจทย์ </v-card-title>
        <v-card-text>
          <v-container>
            <v-form v-model="valid1" ref="form1">
              <v-row>
                <v-col cols="6">
                  <v-text-field
                    prepend-icon="mdi-comment-question"
                    label="คำถาม"
                    required
                    color="#fcad74"
                    v-model="question_detail"
                  ></v-text-field>
                </v-col>
                <v-col cols="6">
                  <v-select
                    required
                    :items="question_type"
                    label="รูปแบบการทำ"
                    v-model="question_type"
                    dense
                    solo
                  ></v-select>
                </v-col>
              </v-row>
              <div v-for="(answer, idx) in answerdetail" :key="idx">
                <v-row>
                  <v-col cols="1">
                    <v-checkbox
                      v-model="answer.answer_status"
                      true-value="Y"
                      false-value="N"
                      color="#fcad74"
                    ></v-checkbox>
                  </v-col>
                  <v-col cols="8">
                    <v-text-field
                      label="คำตอบ"
                      color="#fcad74"
                      v-model="answer.answer_detail"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="3">
                    <!-- {{ items }} -->
                    <v-text-field
                      v-model="answer.answer_score"
                      type="number"
                      label="คะเเนน"
                      min="1"
                      dense
                      solo
                    ></v-text-field>
                  </v-col>
                </v-row>
              </div>
              <v-row>
                <v-col cols="6">
                  <v-btn block color="primary" dark @click="addAnswer()">
                    เพิ่ม
                  </v-btn>
                </v-col>
                <v-col cols="6">
                  <v-btn block color="red" dark @click="deleteAnswer()">
                    ลบ
                  </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialogEdit = false">
            ปิด
          </v-btn>
          <v-btn color="blue darken-1" text @click="insertQuestion()">
            บันทึก
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'
// import { db } from '../../../src/firebase'
// import { doc, updateDoc, arrayUnion } from 'firebase/firestore'

export default {
  components: {
    NavbarAdmin
  },
  data: () => ({
    dialog: false,
    dialogEdit: false,
    question_type: ['เลือกได้หลายคำตอบ', 'เลือกได้คำตอบเดียว'],
    selected: '',
    item: [],
    lesson_id: '',
    lesson_name: '',
    lesson_description: '',
    answer: [
      {
        answer_status: '',
        answer_detail: '',
        answer_type: ''
      }
    ],
    answer_status: '',
    answer_detail: '',
    answer_type: '',
    allanswer: [],
    allquestion: [],
    answerdetail: [],
    valid: false,
    valid1: false,
    question_detail: '',
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
    ]
  }),
  created () {
    this.lesson_id = this.$route.params.id
    this.getLesson()
    this.getQuestion()
    this.getAnswer()
  },
  inject: ['getLesson'],
  computed: {
    lessonChilren () {
      return this.getLesson
    }
  },
  methods: {
    alert () {
      alert('จ้าาา')
    },
    addAnswer () {
      this.answerdetail.push({
        answer_detail: '',
        answer_status: 'N',
        answer_score: '',
        question_id: this.question_id
        // answer_type: ''
      })
    },
    deleteAnswer () {
      this.answerdetail.pop({
        answer_detail: '',
        answer_status: 'N',
        answer_score: '',
        question_id: ''

        // answer_type: ''
      })
    },
    addAnswerOnClick (idx) {
      this.allquestion[idx].answer.push({
        answer_detail: '',
        answer_status: 'N',
        answer_type: ''
      })
    },
    addQuestionOnClick () {
      this.allquestion.push({
        question_detail: '',
        answer: []
      })
    },
    OpenDialog () {
      this.dialog = true
    },
    // async insertQuestion () {
    //   await updateDoc(doc(db, 'Question', '1'), {
    //     question1: arrayUnion({ question_detail: 'test' }, { answer_detail: 'ไก่', answer_status: 'Y', answer_type: 'checkbox' })
    //   })
    // }
    // async insertQuestion1 () {
    //   if (this.$refs.form.validate()) {
    //     // กรอกครบมั้ย
    //     var fd = new FormData()
    //     fd.append('allquestion', this.allquestion)

    //     var { data } = await axios.post(
    //       'http://localhost/vue-backend/insertQuestion.php',
    //       fd
    //     )
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
    //     this.getLesson()
    //     this.getLesson()
    //     this.postuser.post_detail = ''
    //     this.$refs.form.reset()
    //   }
    // },
    async insertQuestion () {
      if (this.$refs.form.validate()) {
        // กรอกครบมั้ย
        var { data } = await axios.post(
          'http://localhost/vue-backend/insertQuestion.php',
          {
            question_detail: this.question_detail,
            question_type: this.question_type,
            lesson_id: this.item.lesson_id,
            answerdetail: this.answerdetail
          }
        )
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
        // this.getLesson()
        // this.getLesson()
        // this.postuser.post_detail = ''
        // this.$refs.form.reset()
        this.dialog = false
        this.$refs.form.reset()
        // this.answer.answer_detail = ''
        // this.allanswer = ''
      }
    },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialogEdit = true
      this.question_id = data.question_id
      this.question_detail = data.question_detail
      this.question_type = data.question_type
      // this.answer_status = data.answer.answer_status
      console.log(data, 'นี่จ้า')
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate () {
      var bodyValue = {
        question_detail: this.question_detail,
        question_type: this.question_type
        // answerdetail: this.answerdetail
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
    async deleteItem (data) {
      // var idDel = parseInt(data.id)
      var { data: deletes } = await axios.post(
        'http://localhost/vue-backend/deleteLesson.php',
        {
          question_id: data.question_id
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
    async getLesson () {
      axios
        .get('http://localhost/vue-backend/lesson.php?id=this.lesson_id')
        .then((res) => {
          console.log('data:', res.data)
          if (res.data) {
            this.item = res.data[this.lesson_id - 2]
            console.log('item', this.item)
          }
        })
    },
    async getQuestion () {
      // console.log('rewload')
      const a = this
      await axios
        .get('http://localhost/vue-backend/question.php')
        .then(async (res) => {
          // console.log('data:', res.data)
          if (res.data) {
            a.allquestion = res.data
            // const i = 0
            console.log(res.data, 'hhhh')
          }
        })
      console.log('done')
    },
    async getAnswer () {
      axios.get('http://localhost/vue-backend/answer.php').then((res) => {
        console.log('answer:', res.data)
        if (res.data) {
          this.allanswer = res.data
          console.log(this.allanswer, 'answer')
        }
      })
    }
  }
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
.v-breadcrumbs >>> a {
  color: #fcad74;
}
</style>
