<template>
    <div>
      <NavbarAdmin />
      <pre>{{ allquestion }} </pre>
      <v-card class="mt-4" v-for="(question, index) in allquestion" :key="index">
        <v-card-title>
          <v-icon class="mr-2" color="#fcad74">mdi-comment-question</v-icon>
          <v-form v-model="valid" ref="form">
            <v-text-field v-model="question.question_detail" :label="`คำถาม ${index + 1}`"></v-text-field>
            <!-- {{ question.answer_detail }} -->
          </v-form>
          <v-spacer></v-spacer>
          <v-select :items="items" label="รูปแบบการทำ" dense solo v-model="selected"></v-select>
        </v-card-title>
        <pre>{{ answer }}</pre>
        <!-- <div v-for="(item, idx) in question.answer" :key="idx">
          <v-row align="center">
            <v-checkbox v-model="item.answer_status" true-value="Y" false-value="N" hide-details class="shrink ml-3 mt-0">
            </v-checkbox>
            <v-text-field :label="`คำตอบ ${idx + 1}`" class="mr-3" v-model="item.answer_detail">
            </v-text-field>
          </v-row>
        </div> -->
        <div class="d-flex justify-end mb-2">
          <!-- <v-btn @click="addAnswerOnClick(index)">เพิ่มคำตอบ</v-btn> -->
        </div>
      </v-card>
      <div>
        <v-btn @click="addQuestionOnClick()">เพิ่มคำถาม</v-btn>
        <v-btn @click="insertQuestion()">บันทึก</v-btn>
      </div>
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
    items: ['Checkbox', 'Radio Button'],
    selected: '',
    answer: [],
    allquestion: [],
    valid: false,
    question_detail: ''
  }),
  methods: {
    alert () {
      alert('จ้าาา')
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
        question_detail: ''
      })
    },
    async insertLesson () {
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
        this.$router.push('/editlesson')
        this.getLesson()
        // this.getLesson()
        // this.postuser.post_detail = ''
        // this.$refs.form.reset()
      }
    }
  }
}
</script>

  <style>
  * {
    font-family: "Prompt", sans-serif;
  }

  .cardShowuser {
    margin-top: 5%;
  }

  .head {
    background-color: red;
  }
  </style>
