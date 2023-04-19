<!-- eslint-disable quotes -->
<!-- eslint-disable quotes -->
<template>
  <div>
    <NavbarUser />
    <div class="row">
      <div class="col-md-12">
        <div class="title">
          <h1>แบบทดสอบหลังเรียน</h1>
          <div v-for="(question,index) in test" :key="index">
          <h2>{{ question.question_detail }}</h2>
          <div v-for="(answer,index) in question.answer" :key="index">
            <!-- <h2>{{ answer.answer_detail }}</h2> -->
          </div>
        </div>
          <br />
          <h2>บทที่ {{ item.lesson_id }} {{ item.lesson_name }}</h2>
        </div>
      </div>
    </div>
    <v-card class="mx-auto mb-5" v-for="question in allquestion" :key="question.question_id">
      <v-card-title>{{ question.question_detail }}</v-card-title>
      <v-card-subtitle>
        <!-- <v-card-text> -->
        <div v-for="answer in allanswer" v-bind:key="answer.answer_id">
          <div v-if="answer.question_id === question.question_id">
            <!-- <div>{{ allanswer }}</div> -->
            <v-radio-group v-model="answer.answer_status" row>
              <!-- <div>{{ answer }}</div> -->
              <!-- <div>{{ allanswer }}</div> -->
              <v-radio color="orange" :label="answer.answer_detail"></v-radio>
              <!-- <div>{{ answer.answer_detail}}</div> -->
            </v-radio-group>
          </div>
        </div>
        <!-- </v-card-text> -->
      </v-card-subtitle>

      <!-- <v-card-actions>
         <v-btn
           text
           color="deep-purple accent-4"
         >
           Learn More
         </v-btn>
      </v-card-actions>-->
    </v-card>
    <!-- <div class="container-fluid bg-3 ">
                   <div class="col-md-12">
                       <div class="card">
                           <h3>ไก่กับไข่อะไรเกิดก่อนกัน ?</h3><br>
                       <div class="control">
                       <label class="radio">
                           <input type="radio" name="foobar">
                           ไก่
                       </label><br>
                       <label class="radio">
                           <input type="radio" name="foobar" checked>
                           ไข่
                       </label>
                   </div>
               </div>

                <div class="card">
                           <h3>ไก่กับไข่อะไรเกิดก่อนกัน ?</h3><br>
                       <div class="control">
                       <label class="radio">
                           <input type="radio" name="kai">
                           ไก่
                       </label><br>
                       <label class="radio">
                           <input type="radio" name="kai" checked>
                           ไข่
                       </label>
                   </div>
               </div>
                <div class="card">
                           <h3>ไก่กับไข่อะไรเกิดก่อนกัน ?</h3><br>
                       <div class="control">
                       <label class="checkbox">
                           <input type="checkbox" name="kai">
                           ไก่
                       </label><br>
                       <label class="checkbox">
                           <input type="checkbox" name="kai">
                           ไข่
                       </label>
                   </div>
    </div>-->
  </div>
  <!-- </div>
  </div>-->
</template>

<script>
import NavbarUser from '@/components/NavbarUser'
import axios from 'axios'
import Swal from 'sweetalert2'
import { db } from '../../../src/firebase'
// import { collection, getDocs, query, where } from 'firebase/firestore'
import { collection, getDocs } from 'firebase/firestore'

export default {
  components: {
    NavbarUser
  },
  data: () => ({
    // reveal: false
    test: [],
    item: '',
    panel: '',
    loading: true,
    allquestion: [],
    allanswer: [],
    question_id: '',
    question_detail: '',
    lesson_id: '',
    answer_status: '',
    question: {
      question_id: '',
      question_detail: '',
      answers: []
    },
    answer_id: '',
    answer_detail: '',
    answer: {
      answer_id: '',
      answer_detail: '',
      question_id: '',
      answer_status: ''
    },
    // answer: {
    //   answer_id: '',
    //   answer_detail: ''
    // },
    radios: null,
    radio: '',
    show: false
  }),
  created () {
    this.lesson_id = this.$route.params.id
    this.getLesson()
    this.getQuestion()
    this.getAnswer()
    this.getData()
    // console.log('rewload')
    // const a = this
    // await axios.get('http://localhost/vue-backend/question.php').then(async (res) => {
    //   // console.log('data:', res.data)
    //   if (res.data) {
    //     a.allquestion = res.data
    //     a.allquestion.forEach((element) => {
    //       console.log(element.question_id)
    //     })
    //     // const i = 0
    //     console.log(res.data, 'hhhh')
    //   }
    // })
    // console.log('done')
  },
  //   async updated () {
  //     await this.getAnswer()
  //     this.loading = false
  //   },
  //   async mounted () {
  //     await this.getQuestion()
  //     await this.ccccc()
  //   },
  computed: {
    lessonChilren () {
      return this.getLesson
    }
  },
  methods: {
    async getData () {
      const cl = collection(db, 'Question')
      const getDoc = await getDocs(cl)
      const question = getDoc.docs.map((doc) =>
        ({
          ...doc.data()
        }))
      this.test = (question)
      console.log('cl cl', question)
    },
    // showtest (index, quizid) {
    //   this.show = index
    //   this.panel = quizid
    //   this.answer_detail = ''
    // },
    // showtest2 (index) {
    //   this.show = !index
    //   this.panel = ''
    // },
    // showRadio (index, questionid) {
    //   this.show = index
    //   this.radio = questionid
    //   this.answer_detail = ''
    // },
    // showtest2 (index) {
    //   this.show = !index
    //   this.radio = ''
    // },
    // async ccccc () {
    //   this.allquestion.forEach(async element => {
    //     await this.getAnswer1().then(data => {
    //       element.answers = data
    //       // i += 1
    //       console.log(element, 'ggg')
    //     })
    //   })
    //   // this.allquestion.anwsers = this.getAnswer1
    //   console.log(this.allquestion, 'testtttttt')
    //   // this.allquestion = xx
    //   // this.allquestion[0].aaaa = 'yhuyuhbububyg'
    //   // this.loading = false
    // },
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
    },
    async writePost () {
      // console.log(this.$refs.form.validate(), 'pp')
      if (this.$refs.form.validate()) {
        // กรอกครบมั้ย
        var { data } = await axios.post(
          'http://localhost/vue-backend/insertPost.php',
          {
            // post_id: this.post_id,
            answer_status: this.answer_status,
            user_id: 61
          }
        )
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
        this.getPost()
        // this.postuser.post_detail = ''
        this.$refs.form.reset()
      }
    }
    // async getAnswer1 () {
    //   const a = await (
    //     await axios.get('http://localhost/vue-backend/answer.php')
    //   ).data
    //   console.log(a)
    //   if (a.length > 0) return a
    //   // return []
    // }
  }
  //   mounted () {
  //     this.$emit('test', true)
  //   }
}
</script>

<style lang="scss" scoped>
* {
  font-family: "Prompt", sans-serif;
}

.title {
  text-align: center;
  margin: 50px;
}

p {
  margin-top: 40px;
  // text-indent: 2.5em;
}

h2 {
  color: #56a062;
}

.card {
  margin-right: auto;
  margin-left: auto;
  width: 80%;
  //   box-shadow: 2px 2px 2px 2px #56a06289;
  transition: 0.3s;
  border-radius: 5px;
  /* 5px rounded corners */
  padding: 30px;
  margin-bottom: 30px;
}

.row {
  margin-left: auto;
  margin-right: auto;
}

/* Add rounded corners to the top left and the top right corner of the image */
img {
  border-radius: 5px 5px 0 0;
}

.button:hover {
  box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24),
    0 17px 50px 0 rgba(0, 0, 0, 0.19);
}

button {
  // background-color: #56a062;
  font-size: 1.3em;
  padding: 10px;
  border-radius: 25px;
  color: aliceblue;
  margin-right: auto;
  margin-left: auto;
}
</style>
