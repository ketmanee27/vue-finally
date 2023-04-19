<template>
<div>
  <NavbarAdmin />
    <div>
<v-breadcrumbs
  :items="breadcrumbs"
  large
></v-breadcrumbs>
</div>
<center><v-card class="cardShowuser mt-0" width="600" >
    <v-card-title>
        <!-- <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
      </v-tab-item>
    </v-tabs-items> -->
        <v-icon class="mr-2" color="#fcad74">mdi-account</v-icon>
        บัญชีผู้ใช้
        <v-spacer></v-spacer>
        <v-row justify="end" class="mr-2">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
              icon
              color="green"
              v-bind="attrs"
          v-on="on"

            >
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
      </template>
      <v-card>
        <v-card-title> แก้ไขบัญชีผู้ใช้ </v-card-title>
              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-text-field
                        label="ชื่อ"
                        v-model="user.user_firstname"
                        :rules="firstnameRules"
                        :error-messages="nameErrors"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="นามสกุล"
                        v-model="user.user_lastname"
                        :rules="lastnameRules"
                        :error-messages="lastnameErrors"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="อีเมล"
                        v-model="user.user_email"
                        :rules="emailRules"
                        :error-messages="emailErrors"
                        type="email"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col
          cols="12"
                  >
      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="user.user_birthday"
            label="วันเดือนปีเกิด"
            :rules="birthdayRules"
            prepend-inner-icon="mdi-calendar-range"
            required
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="user.user_birthday" locale="th" @input="menu = false"></v-date-picker>
      </v-menu>
     </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="อายุ"
                        v-model="user.user_age"
                        required
                        disabled
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="อำเภอ"
                        v-model="user.user_district"
                        :rules="districtRules"
                        :error-messages="districtErrors"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="จังหวัด"
                        v-model="user.user_province"
                        :rules="provinceRules"
                        :error-messages="provinceErrors"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                      label="กลุ่มผู้ใช้งาน"
                        v-model="user.user_type"
                        disabled
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
  </v-row>
        <!-- <button @click="exportUser()" value="Export">โหลด</button> -->
        <!-- <form >
     <input type="submit" name="export" class="btn btn-success"  />
    </form> -->
      </v-card-title>

    <v-divider></v-divider>
    <v-row justify="center" class="ma-5">
      <v-avatar color="#ffeee2">
          <span class="text-uppercase" style="font-size: 25px; color:#fcad74;">{{ user.user_firstname[0] }}{{ user.user_lastname[0] }}</span>
        </v-avatar>
    </v-row>
    <v-card-text>
  <v-container>
    <v-row >
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">ชื่อ </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_firstname }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">นามสกุล </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_lastname }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">อีเมล</span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_email }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">วันเดือนปีเกิด </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_birthday }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">อายุ </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_age }} ปี</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">อำเภอ </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_district }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">จังหวัด </span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_province }}</v-col>
    </v-row>
    <v-row>
      <v-col cols="4" align="start"><span class="primary--text mr-5 font-weight-medium" style="font-size: 1.2em; margin-bottom:10px;">กลุ่มผู้ใช้งาน</span></v-col>
      <v-col cols="8" align="start" style="font-size: 1.1em;">{{ user.user_type }}</v-col>
    </v-row>
  </v-container>
      </v-card-text>
    <!-- <v-virtual-scroll
      :items="items"
      :item-height="50"
      height="300"
    >
      <template v-slot:default="{ item }">
        <v-list-item>
          <v-list-item-avatar>
            <v-avatar
              :color="item.color"
              size="56"
              class="white--text"
            >
              {{ item.initials }}
            </v-avatar>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>{{ item.fullName }}</v-list-item-title>
          </v-list-item-content>

          <v-list-item-action>
            <v-btn
              depressed
              small
            >
              View User

              <v-icon
                color="orange darken-4"
                right
              >
                mdi-open-in-new
              </v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </template>
    </v-virtual-scroll> -->
  </v-card>
  </center>
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
    valid: false,
    dialog: false,
    menu: false,
    firstnameRules: [
      v => !!v || 'กรุณากรอกชื่อ'
    ],
    lastnameRules: [
      v => !!v || 'กรุณากรอกนามสกุล'
    ],
    emailRules: [
      v => !!v || 'กรุณากรอกอีเมล',
      v => /.+@.+\..+/.test(v) || 'กรุณาใส่กรอกอีเมลให้ถูกต้อง'
    ],
    birthdayRules: [
      v => !!v || 'กรุณากรอกวันเดือนปีเกิด'
    ],
    districtRules: [
      v => !!v || 'กรุณากรอกอำเภอ'
    ],
    provinceRules: [
      v => !!v || 'กรุณากรอกจังหวัด'
    ],
    user: {
      user_id: localStorage.getItem('id'),
      user_firstname: localStorage.getItem('user_firstname'),
      user_lastname: localStorage.getItem('user_lastname'),
      user_email: localStorage.getItem('user_email'),
      user_age: localStorage.getItem('user_age'),
      user_birthday: localStorage.getItem('user_birthday'),
      user_district: localStorage.getItem('user_district'),
      user_province: localStorage.getItem('user_province'),
      user_type: localStorage.getItem('type'),
      create_at: localStorage.getItem('create_at')
    },
    breadcrumbs: [
      {
        text: 'Dashboard',
        disabled: false,
        href: 'admindashboard'
      },
      {
        text: 'บัญชีผู้ใช้',
        disabled: true,
        href: 'adminprofile'
      }
    ]

  }),

  methods: {
    genRandomIndex (length) {
      return Math.ceil(Math.random() * (length - 1))
    },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.user.user_firstname = data.user_firstname
      this.user.user_lastname = data.user_lastname
      this.user.user_email = data.user_email
      this.user.user_age = data.user_age
      this.user.user_birthday = data.user_birthday
      this.user.user_district = data.user_district
      this.user.user_province = data.user_province
      this.user.user_type = data.type
      this.user.create_at = data.create_at

      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate () {
      localStorage.setItem('id', this.user.user_id)
      localStorage.setItem('type', this.user.user_type)
      localStorage.setItem('user_firstname', this.user.user_firstname)
      localStorage.setItem('user_lastname', this.user.user_lastname)
      localStorage.setItem('user_email', this.user.user_email)
      localStorage.setItem('user_birthday', this.user.user_birthday)
      localStorage.setItem('user_age', this.user.user_age)
      localStorage.setItem('user_district', this.user.user_district)
      localStorage.setItem('user_province', this.user.user_province)
      localStorage.setItem('create_at', this.create_at)

      var bodyValue = {

        user_id: this.user.user_id,
        user_firstname: this.user.user_firstname,
        user_lastname: this.user.user_lastname,
        user_email: this.user.user_email,
        user_age: this.user.user_age,
        user_birthday: this.user.user_birthday,
        user_district: this.user.user_district,
        user_province: this.user.user_province,
        user_type: this.user.user_type,
        create_at: this.create_at

      }
      var { data } = await axios.put('http://localhost/vue-backend/updateUser.php', bodyValue)
      console.log(data, 'data here!')
      this.dialog = true
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
      // setTimeout(() => {
      //   this.getData()
      // }, 2000)
      this.dialog = false
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap');

*{
  font-family: 'Prompt', sans-serif !important;
}
.v-breadcrumbs >>> a {
    color: #fcad74 ;
}
</style>
