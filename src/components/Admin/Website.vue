<template>
<div>
  <NavbarAdmin/>
  <div>
<v-breadcrumbs
  :items="breadcrumbs"
  large
></v-breadcrumbs>
</div>
  <v-card class="cardShowuser mt-0">
    <v-card-title>
      <v-icon class="mr-2" color="#fcad74">mdi-link</v-icon>
     เว็บไซต์ที่เกี่ยวข้อง
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
      <v-icon dark
      >
        mdi-plus
      </v-icon>
    </v-btn>
    </v-card-title>
    <!-- <v-card-title>friend</v-card-title> -->
       <v-data-table
       :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
       :items="allwebsite"
       :headers="headers"
       :items-per-page="5"
       :search="search"
       no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา">
       <template slot="data">
        <td>{{lesson_id}}</td>
        <!-- <td>{{website_id}}</td> -->
        <td>{{website_name}}</td>
        <td>{{website_link}}</td>
      </template>
      <template v-slot:item.edit="{ item }">
      <v-icon
        small
        @click="editItem(item)"
        color="#56a062"
      >
        mdi-pencil
      </v-icon>
    </template>
    <template v-slot:item.delete="{ item }">
      <v-icon
        small
        @click="deleteItem(item)"
        color="#ea5859"
      >
        mdi-delete
      </v-icon>
    </template>
    </v-data-table>
    <v-dialog v-model="dialog1" max-width="600px" persistent>
             <v-card>
          <v-card-title> เพิ่มเว็บไซต์ </v-card-title>
          <v-card-text>
            <v-container>
              <v-form v-model="valid1" ref="form1">
              <v-row>
                <v-col cols="12">
                  <v-select
          :items="alllesson"
          item-text="lesson_id"
          label="บทที่"
          v-model="website.lesson_id"
          dense
        ></v-select>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ชื่อเว็บไซต์"
                    required
                    v-model="website.website_name"
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="ลิงก์เว็บไซต์"
                    v-model="website.website_link"
                    required
                  ></v-text-field>
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
            <v-btn color="blue darken-1" text @click="insertWebsite()"> บันทึก </v-btn>
          </v-card-actions>
        </v-card>
                </v-dialog>
                <v-dialog v-model="dialog" max-width="600px" persistent>
                      <v-card>
          <v-card-title> แก้ไขเว็บไซต์ </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-select
          :items="alllesson"
          item-text="lesson_id"
          label="บทที่"
          v-model="lesson_id"
          dense
        ></v-select>
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
  </v-card>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'

import dedent from 'dedent'
export default {
  components: {
    NavbarAdmin
  },
  data () {
    return {
      dialog: false,
      dialog1: false,
      alllesson: [],
      allwebsite: [],
      lesson_id: '',
      lesson_unit: '',
      website_id: '',
      website_name: '',
      website_link: '',
      valid: false,
      valid2: false,
      search: '',
      website: {
        lesson_id: '',
        website_id: '',
        website_name: '',
        website_link: ''

      },
      headers: [
        {
          text: 'บทที่',
          align: 'start',
          value: 'lesson_id'
        },
        { text: 'ชื่อบทเรียน', value: 'lesson_name' },
        { text: 'ชื่อเว็บไซต์', value: 'website_name' },
        { text: 'ลิงก์เว็บไซต์', value: 'website_link' },
        // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
        { text: 'แก้ไข', value: 'edit', sortable: false },
        { text: 'ลบ', value: 'delete', sortable: false }

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
          text: 'จัดการเว็บไซต์ที่เกี่ยวข้อง',
          disabled: true,
          href: 'adminwebsite'
        }
      ]
    }
  },
  created () {
    this.getWebsite()
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
    async getWebsite () {
      axios.get('http://localhost/vue-backend/editWebsite.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allwebsite = res.data
        }
      })
    },
    OpenDialog () {
      this.dialog1 = true
      this.$refs.form1.reset()
    },
    async insertWebsite () {
      if (this.$refs.form1.validate()) { // กรอกครบมั้ย
        var { data } = await axios.post('http://localhost/vue-backend/insertWebsite.php', {
          // post_id: this.post_id,
          lesson_id: this.website.lesson_id,
          website_name: this.website.website_name,
          website_link: this.website.website_link
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
        this.dialog1 = false
        this.getWebsite()
      }
    },
    // async saveInsert () {
    //   var bodyValue = {
    //     lesson_id: this.lesson_id,
    //     lesson_unit: this.lesson_unit,
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
      this.website_name = data.website_name
      this.website_link = data.website_link
      this.create_at = data.create_at

      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate () {
      var bodyValue = {
        lesson_id: this.lesson_id,
        website_name: this.website_name,
        website_link: this.website_link,
        create_at: this.create_at

      }
      var { data } = await axios.put('http://localhost/vue-backend/updateWebsite.php', bodyValue)
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
        this.getWebsite()
      // setTimeout(() => {
      //   this.getData()
      // }, 2000)
      }
    },
    // closedialog () {
    //   this.dialog = false
    // }
    async deleteItem (data) {
      var { data: deletes } = await axios.post(
        'http://localhost/vue-backend/deleteWebsite.php',
        {
          website_id: data.website_id
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
          this.getWebsite()
        }, 1500)
      }
    }
  // mounted () {
  //   this.getUser()
  // }
  }
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
