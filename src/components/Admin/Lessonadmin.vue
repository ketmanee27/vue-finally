<template>
<div >
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
    <v-card class="mx"  :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover } ">
      <v-row>
      <v-col lg="9"
              md="9"
              sm="9"
              xl="9"
              cols="6"
              >
      <div class="text-center mt-0">
        <p> บทที่ 12 <span class="text-title">พันธุ์ไก่พื้นเมือง </span></p></div>
        </v-col>
            <v-col lg="1"
            md="1"
            sm="1"
            xl="1"
            cols="2">
            <a href="lessoninsert">
                 <v-btn class="bt"
                    fab
                    small
                    color="#FDD470"
                    @click="insertItem(lessoninsert)">
                <v-icon color="#fff"> mdi-plus </v-icon>
              </v-btn></a>
              </v-col>
              <v-col lg="1"
              md="1"
              sm="1"
              xl="1"
              cols="2">

              <a href="lessonedit">
              <v-btn
                      @click="edit(lessonedit)"
                      class="bt"
                      fab
                      small
                      color="#56a062"
                    >
                      <v-icon color="#fff"> mdi-pencil </v-icon>
                    </v-btn> </a>
                    </v-col>

                    <v-col lg="1"
                    md="1"
                    sm="1"
                    xl="1"
                    cols="2">
                     <a href="lessoninsert">
                    <v-btn class="bt"
                    fab
                    small
                    color="#D0322D"
                    @click="deleteItem(login)">
                    <v-icon color="#fff"> mdi-delete</v-icon>
              </v-btn></a>
              </v-col>
            </v-row>
       </v-card>
    </v-card-text>

    <v-card-text>
    <v-card class="mx"  :elevation="hover ? 12 : 2" :class="{ 'on-hover': hover } ">
      <v-row>
      <v-col lg="9"
              md="9"
              sm="9"
              xl="6"
              cols="6"
              >
      <div class="text-center mt-0">
        <p> บทที่ 12 <span class="text-title">พันธุ์ไก่พื้นเมือง </span></p></div>
        </v-col>
            <v-col lg="1"
            md="1"
            sm="1"
            xl="1"
            cols="2">
                 <v-btn class="bt"
                    fab
                    small
                    color="#FDD470"
                    @click="insertItem(login)">
                <v-icon color="#fff"> mdi-plus </v-icon>
              </v-btn>
              </v-col>
              <v-col lg="1"
              md="1"
              sm="1"
              xl="1"
              cols="2">
              <v-btn
                      @click="edit(login)"
                      class="bt"
                      fab
                      small
                      color="#56a062"
                    >
                      <v-icon color="#fff"> mdi-pencil </v-icon>
                    </v-btn>
                    </v-col>
                    <v-col lg="1"
                    md="1"
                    sm="1"
                    xl="1"
                    cols="2">
                    <v-btn class="bt"
                    fab
                    small
                    color="#D0322D"
                    @click="deleteItem(login)">
                    <v-icon color="#fff"> mdi-delete</v-icon>
              </v-btn>
              </v-col>
            </v-row>
       </v-card>
    </v-card-text>
 </div>
</template>
<script>
export default {
  data: () => ({
    reveal: false
  })
  // mounted () {
  //   this.$emit('test', true)
  // }
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
  // margin-top: 40px;
  // height: 400px;
  padding: 10px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}
.text-center{
  font-size: 1em;
  font-style: bold;
  padding: 15px;
  color: #56a062;
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
  margin: 15px;
}
</style>
