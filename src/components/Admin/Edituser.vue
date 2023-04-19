<template>
  <v-app>
    <NavbarAdmin/>
    <!-- <h1>{{ props.msg }}</h1> -->
    <h1 class="mt-5" align="center">รายชื่อผู้ใช้</h1>
    <v-container>
        <!-- <v-card>
    <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
  </v-card> -->

<v-card >

    <v-toolbar
      color="#FDD470"
      dark
      flat
      prominent
      class="pa-3"
      height="70px"
    >
      <v-text-field
      v-model="search"
        class="mx-10"
        flat
        hide-details
        label="ค้นหา"
        prepend-inner-icon="mdi-magnify"
        solo-inverted
      ></v-text-field>

      <template v-slot:extension>
        <v-tabs
          v-model="tabs"
          centered
        >
          <v-tab
            v-for="item in items"
            :key="item"
          >
            {{ item }}
          </v-tab>
        </v-tabs>
      </template>
    </v-toolbar>

    <v-tabs-items v-model="tabs">
      <v-tab-item>
        <v-card flat>

    <v-simple-table fixed-header >
      <template v-slot:default >
        <thead >
          <tr>
            <th class="text-left">ชื่อ</th>
            <th class="text-left">นามสกุล</th>
            <th class="text-left">อีเมล</th>
            <th class="text-left">รหัสผ่าน</th>
            <th class="text-left">เบอร์โทร</th>
            <th class="text-left">ประเภทผู้ใช้</th>
            <th class="text-left">อายุ</th>
            <th class="text-left">แก้ไข</th>
            <th class="text-left">ลบ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in alluser" v-bind:key="user.id">
            <td>{{ user.user_firstname }}</td>
            <td>{{ user.user_lastname }}</td>
            <td>{{ user.user_email }}</td>
            <td>{{ user.user_password }}</td>
            <td>{{ user.user_tel }}</td>
            <td>{{ user.user_type }}</td>
            <td>{{ user.user_age }}</td>
            <td>
              <v-row>
                <v-col>
                    <v-btn
                      dark
                      @click="edit(user)"
                      class="mx-1"
                      fab
                      small
                      color="pink"
                    >
                      <v-icon dark> mdi-pencil </v-icon>
                    </v-btn>
                </v-col>
              </v-row>
            </td>
            <td>
              <v-btn class="mx-1" fab dark small color="pink" @click="deleteItem(user)">
                <v-icon dark> mdi-delete </v-icon>
              </v-btn>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>
    <v-dialog v-model="dialog" max-width="600px">
                  <v-card>
                    <v-card-title>
                      <span class="text-h5">แก้ไขผู้ใช้</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-row>
                          <v-col cols="12">
                            <v-text-field
                              label="ชื่อ"
                              required
                              v-model="user_firstname"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12">
                            <v-text-field
                              label="นามสกุล"
                              required
                              v-model="user_lastname"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12">
                            <v-text-field
                              label="อีเมล"
                              type="email"
                              v-model="user_email"
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12">
                            <v-text-field
                              label="รหัสผ่าน"
                              type="password"
                              v-model="user_password"
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12">
                            <v-text-field
                              label="เบอร์โทร"
                              v-model="user_tel"
                              required
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12">
                            <v-select
                              v-model="user_type"
                                :items="['นักศึกษา', 'เกษตกร' , 'แอดมิน']"
                                :rules="typeRules"
                                label="กลุ่มผู้ใช้งาน">
                                <template v-slot:item="{ item, attrs, on }">
                                <v-list-item
                                    v-bind="attrs"
                                    v-on="on"
                                >
                                    <v-list-item-title
                                    :id="attrs['aria-labelledby']"
                                    v-text="item"
                                    ></v-list-item-title>
                                </v-list-item>
                                </template>
                            </v-select>
                          </v-col>
                          <v-col cols="12">
                            <v-text-field
                              label="อายุ"
                              v-model="user_age"
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
                      <v-btn color="blue darken-1" text @click="save()">
                        บันทึก
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </v-card>
                </v-container>
  </v-app>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'
export default {
  components: {
    NavbarAdmin
  },
  name: 'show',
  data () {
    return {
      allshow: [],
      alluser: [],
      dialog: false,
      search: '',
      // username: '',
      // email: '',
      // id: '',
      user_id: '',
      user_firstname: '',
      user_lastname: '',
      user_email: '',
      user_password: '',
      user_tel: '',
      user_type: '',
      user_age: '',
      headers: [
        {
          text: 'ชื่อ',
          align: 'start',
          filterable: false,
          value: 'ชื่อ'
        },
        { text: 'นามสกุล', value: 'นามสกุล' },
        { text: 'อีเมล', value: 'อีเมล' },
        { text: 'รหัสผ่าน', value: 'รหัสผ่าน' },
        { text: 'เบอร์โทร', value: 'เบอร์โทร' },
        { text: 'ประเภทผู้ใช้', value: 'ประเภทผู้ใช้' },
        { text: 'อายุ', value: 'อายุ' }
      ],
      user: {
        user_firstname: '',
        user_lastname: '',
        user_email: '',
        user_password: '',
        user_tel: '',
        user_type: '',
        user_age: ''
      },
      tabs: null,
      items: [
        'นักศึกษา', 'เกษตกร', 'แอดมิน'
      ]
    }
  },
  created () {
    this.getUser()
  },
  // mounted () {
  //   this.$emit('test', true)
  // },
  // mounted () {
  // },
  methods: {
    async getUser () {
      axios.get('http://localhost/vue-backend/editUser.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
        }
      })
    },
    edit (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.user_id = data.user_id
      this.user_firstname = data.user_firstname
      this.user_lastname = data.user_lastname
      this.user_email = data.user_email
      this.user_password = data.user_password
      this.user_tel = data.user_tel
      this.user_type = data.user_type
      this.user_age = data.user_age
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async save () {
      var bodyValue = {
        user_id: this.user_id,
        user_firstname: this.user_firstname,
        user_lastname: this.user_lastname,
        user_email: this.user_email,
        user_password: this.user_password,
        user_tel: this.user_tel,
        user_type: this.user_type,
        user_age: this.user_age

      }
      var { data } = await axios.put('http://localhost/vue-backend/updateUser.php', bodyValue)
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
        this.getUser()
      }
    },
    // closedialog () {
    //   this.dialog = false
    // }
    async deleteItem (data) {
      // var idDel = parseInt(data.id)
      var { data: deletes } = await axios.post('http://localhost/vue-backend/deleteUser.php', {
        user_id: data.user_id
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
        this.getUser()
      }
    },
    computed: {
      alluser () {
        return this.alluser.filter(post => {
          return post.user_firstname.toLowerCase().includes(this.search.toLowerCase())
        })
      }
    }
  }
}
</script>

<style>
*{
font-family: 'Prompt', sans-serif;
}
.csss {
  /* color: black !important; */
  font-family: 'Kanit';
  font-weight: 400;
}
</style>
