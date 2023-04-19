<template>
<div >
  <NavbarAdmin/>
  <v-container>
    <center>
      <div class="row">
        <div class="col-md-12">
  <h1 class="lesson">บทเรียน</h1>
        </div>
      </div>
      <div class="text-center mt-0">
      <div class="row">
        <div class="col-md-8 col-sm-5 col-lg-8 col-4">
    <v-simple-table fixed-header >
      <template v-slot:default>
       <thead>
          <tr>
            <th class="text-left">บทเรียน</th>
          </tr>
        </thead>
      </template>
    </v-simple-table>
        </div>
        <div class="col-md-4 col-sm-7 col-lg-4 col-8">
    <v-simple-table fixed-header >
      <template v-slot:default>
       <thead>
          <tr>
            <th class="text-right">ลบ</th>
            <th class="text-right">แก้ไข</th>
            <th class="text-right">เพิ่ม</th>
          </tr>
        </thead>
      </template>
    </v-simple-table>
        </div>
      </div>
      </div>
  <v-card-text>
    <v-card class="mx"  v-for="lesson in alllesson" v-bind:key="lesson.id" :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover } ">
      <v-row>
      <v-col lg="9"
              md="9"
              sm="9"
              xl="9"
              cols="6"
              >
      <div class="text-center mt-0">
        <p>{{lesson.lesson_unit}} <span class="text-title">{{lesson.lesson_name}} </span></p></div>
        </v-col>
            <v-col lg="1"
            md="1"
            sm="1"
            xl="1"
            cols="2">
            <a href="insertlesson">
                 <v-btn class="bt"
                    fab
                    small
                    color="#FDD470"
                    @click="insertItem(lesson)">
                <v-icon color="#fff"> mdi-plus </v-icon>
              </v-btn></a>
              <!-- </a> -->
              </v-col>
              <v-col lg="1"
              md="1"
              sm="1"
              xl="1"
              cols="2">

              <!-- <a href="lessonedit"> -->
              <v-btn
                      @click="edit(lesson)"
                      class="bt"
                      fab
                      small
                      color="#56a062"
                    >
                      <v-icon color="#fff"> mdi-pencil </v-icon>
                    </v-btn>
                    <!-- </a> -->
                    </v-col>

                    <v-col lg="1"
                    md="1"
                    sm="1"
                    xl="1"
                    cols="2">
                     <!-- <a href="lessoninsert"> -->
                    <v-btn class="bt"
                    fab
                    small
                    color="#D0322D"
                    @click="deleteItem(lesson)">
                    <v-icon color="#fff"> mdi-delete</v-icon>
              </v-btn>
              <!-- </a> -->
              </v-col>
            </v-row>
       </v-card>
    </v-card-text>
    </center>
</v-container>
       <v-dialog v-model="dialog" max-width="600px">
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">แก้ไขบทเรียน</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container fluid>
    <v-row>
      <v-col cols="4">
        <v-subheader>บทที่ : </v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
         color="#56a062"
         loading
         v-model="lesson_unit"

  ></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="4">
        <v-subheader>บทเรียนเรื่อง : </v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
          color="#56a062"
         loading
         v-model="lesson_name"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="4">
        <v-subheader>เนื้อหาบทเรียน : </v-subheader>
      </v-col>
      <v-col cols="8">
        <v-textarea
          solo
          name="input-7-4"
          label=""
          v-model="lesson_description"
        ></v-textarea>
         <!-- <v-text-field
          color="#56a062"
         loading
         v-model="lesson_description"
        ></v-text-field> -->
      </v-col>
    </v-row>
  </v-container>
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="dialog = false">
                        ปิด
                      </v-btn>
                      <v-btn color="blue darken-1" text @click="save()">
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
export default {
  components: {
    NavbarAdmin
  },
  data: () => ({
    reveal: false,
    dialog: false,
    dialog2: false,
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
    valid: false

  }),
  created () {
    this.getLesson()
  },
  mounted () {
    this.$emit('test', true)
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
    // async insertlesson () {
    //   if (this.$refs.form.validate()) { // กรอกครบมั้ย
    //     var { data } = await axios.post('http://localhost/vue-backend/insertLesson.php', {
    //       lesson_unit: this.lesson_unit,
    //       lesson_name: this.lesson_name,
    //       lesson_description: this.lesson_description
    //     })
    //     if (data === 'success') {
    //       this.dialog2 = true
    //       Swal.fire({
    //         icon: 'success',
    //         title: 'โพสต์สำเร็จ',
    //         showConfirmButton: false,
    //         text: 'คำอธิบาย',
    //         customClass: {
    //           title: 'csss'
    //         },
    //         timer: 1500
    //       })
    //     }
    //     this.getLesson()
    //     // this.postuser.post_detail = ''
    //     this.$refs.form.reset()
    //   }
    // },
    edit (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.lesson_id = data.lesson_id
      this.lesson_unit = data.lesson_unit
      this.lesson_name = data.lesson_name
      this.lesson_description = data.lesson_description
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
    computed: {
      alllesson () {
        return this.alllesson.filter(post => {
          return post.lesson_name.toLowerCase().includes(this.search.toLowerCase())
        })
      }
    }
  }
}
</script>
<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');
*{
font-family: 'Prompt', sans-serif;
}
.text-h4 {
  text-align: center;
  font-size: 20px;
}
// .container{
//   margin-left: 40%;
// }
h1{
  color: #000;
}

.mx{
  margin-top: 40px;
  // height: 400px;
  padding: 10px;
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}
.text-center{
  font-size: 1em;
  font-style: bold;
  padding: 15px;
  color: #56a062;
  margin-top: 10px;
  // text-align: center;
}
.text-title{
  // text-align: center;
  padding: 15px;
  font-size: 1em !important;
  color: rgb(75, 75, 75);
}
a{
  text-decoration:none;
  text-align: center;
  color: #56a062;
}
.lesson{
  text-align: center;
  margin-top: 30px;
}

.v-card {
  transition: opacity .5s ease-in-out rgb(255, 255, 107) ;
   border: 2px solid #56a062 !important;
    border-radius: 21px;
    box-shadow: 1px 1px 9px 9px rgb(174, 237, 223);
    // margin: 20px;
}

.show-btns {
  color: #feedb0 !important;
  box-shadow: 10px 10px 5px 12px rgb(174, 237, 223);
}
.text-right{
  margin: 15px;
  float:right;
  right: 0px;
  position: absolute;  //กำหนดตำแหน่งที่แน่นอน
  margin-right: 20px;
}
.text-left{
  margin: 20px;
  float: left;
}
.bt{
  margin-top: 5px;
  margin-right: 2px;
}
v-card{
  margin: 20px;

}
.button1 {
  background-color: white;
  color: black !important;
  border: 2px solid #FAD335;
   border-radius: 30px;
  margin: 10px;
  padding: 10px;
  width: 20% ;
}
.button1:hover {
  background-color: #FAD335;
  color: white;
}
.button3 {
  background-color: white;
  color: black;
  border: 2px solid #EF5B9B;
  border-radius: 30px;
  margin: 10px;
  padding: 10px;
  width: 20% ;
}
.button3:hover {
  background-color: #EF5B9B;
  color: white;
}
.btn{
  text-align: center;
   margin: 20px;
   padding: 20px;
}
</style>
