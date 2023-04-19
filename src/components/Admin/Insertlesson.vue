<template>
<div >
     <NavbarAdmin/>

      <div class="row">
        <div class="col-md-12">
  <h1 class="lesson">เพิ่มบทเรียน</h1>
        </div>
      </div>
  <v-card-text>
    <v-card class="mx"  :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover } ">
  <v-container fluid>
    <v-row>
      <v-col cols="4">
        <v-subheader>บทที่ : </v-subheader>
      </v-col>
      <v-col cols="8">
        <v-text-field
         color="#56a062"
        v-model="lesson_unit"
         loading
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

    <!-- <v-row>
      <v-col cols="4">
        <v-subheader>เลือกไฟล์ : </v-subheader>
      </v-col>
      <v-col cols="8">
          <v-file-input
          color="#56a062"
         loading
       show-size
    counter
    multiple
    label="File input"
  ></v-file-input>
      </v-col>
    </v-row> -->
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
      </v-col>
    </v-row>
  </v-container>
  <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="dialog = false">
                        ล้าง
                      </v-btn>
                      <v-btn color="blue darken-1" text @click="insertLesson()">
                        เพิ่ม
                      </v-btn>
                    </v-card-actions>
       </v-card>
    </v-card-text>
       <div class="btn">
<!-- <input type="button" class="button button1" value="ตกลง" onclick="window.location.href='lesson'"/>
<input type="button" class="button button3" value="ยกเลิก" onclick="window.location.href='register'"/> -->
</div>
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
    lesson_id: '',
    lesson_unit: '',
    lesson_name: '',
    lesson_description: ''
  }),
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
