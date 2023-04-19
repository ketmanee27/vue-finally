<template>
  <div>
    <NavbarAdmin />
    <div>
<v-breadcrumbs
  :items="breadcrumbs"
  large
></v-breadcrumbs>
</div>
    <v-card class="cardShowuser mt-0">
      <v-tabs background-color="transparent" color="#099fae" grow v-model="tab">
        <v-tab @click="getUser('all')"> ทั้งหมด </v-tab>
        <v-tab @click="getStudent('student')"> นักศึกษา </v-tab>
        <v-tab @click="getFarmer('farmer')"> เกษตรกร </v-tab>
        <v-tab @click="getAdmin('admin')"> แอดมิน </v-tab>
      </v-tabs>
      <v-card-title v-show="type === 'all'">
        <!-- <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
      </v-tab-item>
    </v-tabs-items> -->
        <v-icon class="mr-2" color="#fcad74">mdi-account-cog</v-icon>
        รายชื่อผู้ใช้
        <v-btn class="ml-5 text-capitalize" color="#e5ffee" dark elevation="1" @click="onExportall()">
          <span style="color:#2a7e4a;"><v-icon left> mdi-microsoft-excel </v-icon>Export</span></v-btn>
        <v-spacer></v-spacer>
        <!-- <button @click="exportUser()" value="Export">โหลด</button> -->
        <!-- <form >
     <input type="submit" name="export" class="btn btn-success"  />
    </form> -->
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
      <!-- <v-card-title>friend</v-card-title> -->
      <v-data-table
      :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alluser"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        v-show="type === 'all'"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alluser.length"
      >
        <template slot="data">
          <!-- <td>
                    <v-btn
                      dark
                      @click="edit(data)"
                      class="mx-1"
                      fab
                      small
                      color="pink"
                    >
                      <v-icon dark> mdi-pencil </v-icon>
                    </v-btn>
            </td>
            <td>
              <v-btn class="mx-1" fab dark small color="pink" @click="deleteItem(user)">
                <v-icon dark> mdi-delete </v-icon>
              </v-btn>
            </td> -->
        </template>
        <template v-slot:[`item.user_type`]="{ item }">
          <v-chip v-if="item.user_type === 'นักศึกษา'" color="#e8f9ff">
            <span style="color: #4481eb">{{ item.user_type }}</span>
          </v-chip>

          <v-chip v-else-if="item.user_type === 'เกษตรกร'" color="#eaffed">
            <span style="color: #56a062">{{ item.user_type }}</span>
          </v-chip>

          <v-chip v-else color="#fff5ef">
            <span style="color: #fcad74">{{ item.user_type }}</span>
          </v-chip>
        </template>
        <template v-slot:[`item.quiz`]="{ item }">
          <v-icon small @click="editItem(item)" color="#4481eb">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small @click="editItem(item,type)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item, type)" color="#ea5859">
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
      <div v-if="!alluser.length && type === 'all'">
        <p class="text-center ma-10 pa-10">ไม่พบข้อมูลผู้ใช้งาน</p>
      </div>

      <v-card-title v-show="type === 'student'">
        <!-- <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
      </v-tab-item>
    </v-tabs-items> -->
        <v-icon class="mr-2" color="#fcad74">mdi-account-cog</v-icon>
        รายชื่อผู้ใช้
        <v-btn class="ml-5 text-capitalize" color="#e5ffee" dark elevation="1" @click="onExportstudent()">
          <span style="color:#2a7e4a;"><v-icon left> mdi-microsoft-excel </v-icon>Export</span></v-btn>
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
      <v-data-table
      :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alluser"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        v-show="type === 'student'"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alluser.length"
      >
        <template v-slot:[`item.user_type`]="{ item }">
          <v-chip v-if="item.user_type === 'นักศึกษา'" color="#e8f9ff">
            <span style="color: #4481eb">{{ item.user_type }}</span>
          </v-chip>
          <!-- <td>
                    <v-btn
                      dark
                      @click="edit(data)"
                      class="mx-1"
                      fab
                      small
                      color="pink"
                    >
                      <v-icon dark> mdi-pencil </v-icon>
                    </v-btn>
            </td>
            <td>
              <v-btn class="mx-1" fab dark small color="pink" @click="deleteItem(user)">
                <v-icon dark> mdi-delete </v-icon>
              </v-btn>
            </td> -->
        </template>
        <template v-slot:item.quiz="{ item }">
          <v-icon small @click="editItem(item)" color="#4481eb">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small @click="editItem(item,type)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item,type), type" color="#ea5859">
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
            <div v-if="!alluser.length && type === 'student'">
              <p class="text-center ma-10 pa-10">ไม่พบข้อมูลนักศึกษา</p>
      </div>

      <v-card-title  v-show="type === 'farmer'">
        <!-- <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
      </v-tab-item>
    </v-tabs-items> -->
        <v-icon class="mr-2" color="#fcad74">mdi-account-cog</v-icon>
        รายชื่อผู้ใช้
        <v-btn class="ml-5 text-capitalize" color="#e5ffee" dark elevation="1" @click="onExportfarmer()">
          <span style="color:#2a7e4a;"><v-icon left> mdi-microsoft-excel </v-icon>Export</span></v-btn>
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
      <v-data-table
      :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alluser"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        v-show="type === 'farmer'"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alluser.length"
      >
         <template v-slot:[`item.user_type`]="{ item }">
          <v-chip v--if="item.user_type === 'เกษตรกร'" color="#eaffed">
            <span style="color: #56a062">{{ item.user_type }}</span>
          </v-chip>
          <!-- <td>
                    <v-btn
                      dark
                      @click="edit(data)"
                      class="mx-1"
                      fab
                      small
                      color="pink"
                    >
                      <v-icon dark> mdi-pencil </v-icon>
                    </v-btn>
            </td>
            <td>
              <v-btn class="mx-1" fab dark small color="pink" @click="deleteItem(user)">
                <v-icon dark> mdi-delete </v-icon>
              </v-btn>
            </td> -->
        </template>
        <template v-slot:item.quiz="{ item }">
          <v-icon small @click="editItem(item)" color="#4481eb">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small @click="editItem(item,type)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item,type), type" color="#ea5859">
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
            <div v-if="!alluser.length && type === 'farmer'">
              <p class="text-center ma-10 pa-10">ไม่พบข้อมูลเกษตรกร</p>

      </div>
      <v-card-title  v-show="type === 'admin'">
        <!-- <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
      </v-tab-item>
    </v-tabs-items> -->
        <v-icon class="mr-2" color="#fcad74">mdi-account-cog</v-icon>
        รายชื่อผู้ใช้
        <v-btn class="ml-5 text-capitalize" color="#e5ffee" dark elevation="1" @click="onExportadmin()">
          <span style="color:#2a7e4a;"><v-icon left> mdi-microsoft-excel </v-icon>Export</span></v-btn>
          <v-btn class="ml-5 text-capitalize" color="#e8f0ff" dark elevation="1" @click="openinsertAdmin()">
          <span style="color:#4481eb;"><v-icon left> mdi-plus </v-icon>เพิ่มแอดมิน</span></v-btn>
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
      <v-data-table
      :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alluser"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        v-show="type === 'admin'"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alluser.length"
      >
 <template v-slot:[`item.user_type`]="{ item }">
            <v-chip v-if="item.user_type === 'แอดมิน'" color="#fff5ef">
            <span style="color: #fcad74">{{ item.user_type }}</span>
          </v-chip>
          <!-- <td>
                    <v-btn
                      dark
                      @click="edit(data)"
                      class="mx-1"
                      fab
                      small
                      color="pink"
                    >
                      <v-icon dark> mdi-pencil </v-icon>
                    </v-btn>
            </td>
            <td>
              <v-btn class="mx-1" fab dark small color="pink" @click="deleteItem(user)">
                <v-icon dark> mdi-delete </v-icon>
              </v-btn>
            </td> -->
        </template>
        <template v-slot:item.quiz="{ item }">
          <v-icon small @click="editItem(item)" color="#4481eb">
            mdi-eye
          </v-icon>
        </template>
        <template v-slot:item.edit="{ item }">
          <v-icon small @click="editItem(item,type)" color="#56a062">
            mdi-pencil
          </v-icon>
        </template>
        <template v-slot:item.delete="{ item }">
          <v-icon small @click="deleteItem(item, type)" color="#ea5859">
            mdi-delete
          </v-icon>
        </template>
      </v-data-table>
            <div v-if="!alluser.length && type === 'admin'">
              <p class="text-center ma-10 pa-10">ไม่พบข้อมูลแอดมิน</p>
      </div>
      <!--  -->
      <v-dialog v-model="dialog" max-width="600px">
        <v-form v-model="valid" ref="form" >
        <v-card>
          <v-card-title> แก้ไขผู้ใช้ </v-card-title>
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
                  <v-select
                    v-model="user_type"
                    :items="['นักศึกษา', 'เกษตรกร', 'แอดมิน']"
                    :rules="typeRules"
                    label="กลุ่มผู้ใช้งาน"
                  >
                    <template v-slot:item="{ item, attrs, on }">
                      <v-list-item v-bind="attrs" v-on="on">
                        <v-list-item-title
                          :id="attrs['aria-labelledby']"
                          v-text="item"
                        ></v-list-item-title>
                      </v-list-item>
                    </template>
                  </v-select>
                </v-col>
                <v-col
          cols="12"
        >
              <v-menu
                v-model="menuUpdate"
                :close-on-content-click="false"
                :nudge-right="40"
                transition="scale-transition"
                offset-y
                min-width="290px"
              >
                <template v-slot:activator="{ on, attrs }">
                  <v-text-field
                    v-model="user_birthday"
                    label="วันเดือนปีเกิด"
                    prepend-inner-icon="mdi-calendar-range"
                    required
                    v-bind="attrs"
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="user_birthday" locale="th" @input="menuUpdate = false"></v-date-picker>
              </v-menu>
            </v-col>
                <v-col cols="12">
                  <v-text-field
                    label="อายุ"
                    v-model="user_age"
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
            <v-btn color="blue darken-1" text @click="save(type)"> บันทึก </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
      </v-dialog>
    </v-card>

    <v-dialog
      v-model="dialoginsertAdmin"
      persistent
      max-width="600px"
    >
      <v-card>
        <v-form v-model="validAdmin" ref="formAdmin" >
        <v-card-title>
          เพิ่มแอดมิน
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="ชื่อ"
                  v-model="admin.user_firstname"
                  :rules="firstnameRules"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="นามสกุล"
                  :rules="lastnameRules"
                  v-model="admin.user_lastname"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="อีเมล"
                  :rules="emailRules"
                  v-model="admin.user_email"
                  type="email"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
              <v-text-field
                  label="รหัสผ่าน"
                  v-model="admin.user_password"
                  :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                  :rules="[passwordRules.required, passwordRules.min]"
                  :type="show ? 'text' : 'password'"
                  name="input-10-2"
                  @click:append="show = !show"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
              <v-text-field
                  label="ยืนยันรหัสผ่าน"
                  v-model="admin.user_confirmPassword"
                  :rules="confirmPasswordRules.concat(passwordConfirmationRule)"
                  :append-icon="showConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="showConfirm ? 'text' : 'password'"
                  @click:append="showConfirm = !showConfirm"
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
            v-model="admin.user_birthday"
            label="วันเดือนปีเกิด"
            :rules="birthdayRules"
            prepend-inner-icon="mdi-calendar-range"
            required
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="admin.user_birthday" locale="th" @input="menu = false"></v-date-picker>
      </v-menu>
     </v-col>
              <v-col cols="12">
                <v-text-field
                  label="ประเภทผู้ใช้งาน"
                  v-model="admin.user_type"
                  required
                  disabled
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="อำเภอ"
                  v-model="admin.user_district"
                  :rules="districtRules"
                  required
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <v-text-field
                  label="จังหวัด"
                  :rules="provinceRules"
                  v-model="admin.user_province"
                  required
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialoginsertAdmin = false"
          >
            ปิด
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="insertAdmin()"
          >
            บันทึก
          </v-btn>
        </v-card-actions>
      </v-form>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'
import * as XLSX from 'xlsx'

export default {
  components: {
    NavbarAdmin
  },
  data () {
    return {
      show: false,
      showConfirm: false,
      menu: false,
      menuUpdate: false,
      show3: false,
      password: 'Password',
      rules: {
        required: (value) => !!value || 'Required.',
        min: (v) => v.length >= 8 || 'Min 8 characters',
        emailMatch: () => "The email and password you entered don't match"
      },
      dialoginsertAdmin: false,
      validAdmin: false,
      valid: false,
      dialog: false,
      alluser: [{
        user_firstname: '',
        user_lastname: '',
        user_email: '',
        user_type: '',
        user_age: ''
      }
      ],
      allstudent: [],
      allfarmer: [],
      alladmin: [],
      user_id: '',
      user_firstname: '',
      user_lastname: '',
      user_email: '',
      user_password: '',
      user_type: '',
      user_age: '',
      user_birthday: '',
      admin: {
        user_firstname: '',
        user_lastname: '',
        user_email: '',
        user_password: '',
        user_confirmPassword: '',
        user_type: 'แอดมิน',
        user_age: '',
        user_birthday: ''
      },
      user: {
        user_firstname: '',
        user_lastname: '',
        user_email: '',
        user_type: '',
        user_age: '',
        user_birthday: ''
      },
      search: '',
      headers: [
        {
          text: 'ชื่อ',
          align: 'start',
          // sortable: false,
          value: 'user_firstname'
        },
        { text: 'นามสกุล', value: 'user_lastname' },
        { text: 'อีเมล', value: 'user_email' },
        // { text: 'รหัสผ่าน', value: 'user_password' },
        { text: 'ประเภทผู้ใช้', value: 'user_type' },
        { text: 'วันเดือนปีเกิด', value: 'user_birthday' },
        { text: 'อายุ', value: 'user_age' },
        // { text: 'แก้ไข', value: 'แก้ไข' },
        // { text: 'ลบ', value: 'ลบ' },
        // { text: 'ข้อสอบ', value: 'quiz', sortable: false },
        { text: 'แก้ไข', value: 'edit', sortable: false },
        { text: 'ลบ', value: 'delete', sortable: false }
      ],
      data: {},
      export: 'export',
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'admindashboard'
        },
        {
          text: 'จัดการผู้ใช้',
          disabled: true,
          href: 'adminuser'
        }
      ],
      json: [
        { name: 'Dady', age: '21' },
        { name: 'Jonh', age: '25' },
        { name: 'James', age: '17' }
      ],
      tab: null,
      items: ['ทั้งหมด', 'นักศึกษา', 'เกษตรกร', 'แอดมิน'],
      selected: '',
      type: 'all',
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
      // passwordRules: [v => !!v || 'Password is required'],
      confirmPasswordRules: [v => !!v || 'กรุณากรอกยืนยันรหัสผ่าน'],
      passwordRules: {
        required: value => !!value || 'กรุณากรอกรหัสผ่าน',
        min: v => v.length >= 8 || 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
        emailMatch: () => ('The email and password you entered don\'t match')
      },
      telRules: [
        v => !!v || 'กรุณากรอกเบอร์โทร'
      ],
      ageRules: [
        v => !!v || 'กรุณากรอกอายุ'
      ],
      birthdayRules: [
        v => !!v || 'กรุณากรอกวันเดือนปีเกิด'
      ],
      districtRules: [
        v => !!v || 'กรุณากรอกอำเภอ'
      ],
      provinceRules: [
        v => !!v || 'กรุณากรอกจังหวัด'
      ]

    }
  },
  computed: {
    passwordConfirmationRule () {
      return () =>
        this.admin.user_password === this.admin.user_confirmPassword || 'กรุณากรอกรหัสผ่านให้ตรงกัน'
    }
  },
  created () {
    this.type = 'all'
    this.getUser(this.type)
  },
  methods: {
    async exportUser () {
      var { data } = await axios.post(
        'http://localhost/vue-backend/exportUser.php',
        {
          // post_id: this.post_id,
          export: 1
        }
      )
      if (data === 'success') {
        Swal.fire({
          icon: 'success',
          title: 'ดาวน์โหลดสำเร็จ',
          showConfirmButton: false,
          // text: 'คำอธิบาย',
          customClass: {
            title: 'csss'
          },
          timer: 1500
        })
      }
    },
    async getUser (value) {
      this.type = value
      axios.get('http://localhost/vue-backend/editUser.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
        }
      })
    },
    async getStudent (value) {
      this.type = value
      axios.get('http://localhost/vue-backend/editStudent.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
          this.allstudent = res.data
        }
      })
    },
    async getFarmer (value) {
      this.type = value
      axios.get('http://localhost/vue-backend/editFarmer.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
          this.allfarmer = res.data
        }
      })
    },
    async getAdmin (value) {
      this.type = value
      axios.get('http://localhost/vue-backend/editAdmin.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
          this.alladmin = res.data
        }
      })
    },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.user_id = data.user_id
      this.user_firstname = data.user_firstname
      this.user_lastname = data.user_lastname
      this.user_email = data.user_email
      this.user_type = data.user_type
      this.user_birthday = data.user_birthday
      this.user_age = data.user_age
      this.create_at = data.create_at

      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async save (type) {
      var bodyValue = {
        user_id: this.user_id,
        user_firstname: this.user_firstname,
        user_lastname: this.user_lastname,
        user_email: this.user_email,
        user_type: this.user_type,
        user_birthday: this.user_birthday,
        user_age: this.user_age,
        create_at: this.create_at
      }
      var { data: update } = await axios.put(
        'http://localhost/vue-backend/updateUser.php',
        bodyValue
      )
      console.log(update, 'data here!')
      if (update === 'success') {
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
        setTimeout(() => {
          this.type = type
          this.getReload(this.type)
        }, 1500)
      }
      this.dialog = false
      this.getReload(this.type)
    },
    // closedialog () {
    //   this.dialog = false
    // }
    async deleteItem (data, type) {
      // var idDel = parseInt(data.id)
      var { data: deletes } = await axios.post(
        'http://localhost/vue-backend/deleteUser.php',
        {
          user_id: data.user_id
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
          this.type = type
          this.getReload(this.type)
        }, 1500)
      }
    },
    getReload (type) {
      if (type === 'all') {
        this.getUser('all')
      } else if (type === 'student') {
        this.getStudent('student')
      } else if (type === 'farmer') {
        this.getFarmer('farmer')
      } else {
        // Admin
        this.getAdmin('admin')
      }
    },
    onExportall () {
      const Heading = [['รหัสผู้ใช้งาน', 'ชื่อ', 'นามสกุล', 'อีเมล', 'ประเภทผู้ใช้งาน', 'วันเดือนปีเกิด', 'อายุ', 'อำเภอ', 'จังหวัด', 'วันที่สร้างบัญชี', 'วันที่แก้ไขบัญชี']]
      const dataWS = XLSX.utils.json_to_sheet(
        this.alluser)
      const wb = XLSX.utils.book_new()
      XLSX.utils.sheet_add_aoa(dataWS, Heading)
      XLSX.utils.book_append_sheet(wb, dataWS)
      XLSX.writeFile(wb, 'รายชื่อผู้ใช้งาน.xlsx')
    },
    onExportstudent () {
      const Heading = [['รหัสผู้ใช้งาน', 'ชื่อ', 'นามสกุล', 'อีเมล', 'ประเภทผู้ใช้งาน', 'วันเดือนปีเกิด', 'อายุ', 'อำเภอ', 'จังหวัด', 'วันที่สร้างบัญชี', 'วันที่แก้ไขบัญชี']]
      console.log('student', this.allstudent)
      const dataWS = XLSX.utils.json_to_sheet(this.allstudent)
      const wb = XLSX.utils.book_new()
      XLSX.utils.sheet_add_aoa(dataWS, Heading)
      XLSX.utils.book_append_sheet(wb, dataWS)
      XLSX.writeFile(wb, 'รายชื่อนักศึกษา.xlsx')
    },
    onExportfarmer () {
      // console.log('log')
      const Heading = [['รหัสผู้ใช้งาน', 'ชื่อ', 'นามสกุล', 'อีเมล', 'ประเภทผู้ใช้งาน', 'วันเดือนปีเกิด', 'อายุ', 'อำเภอ', 'จังหวัด', 'วันที่สร้างบัญชี', 'วันที่แก้ไขบัญชี']]
      const dataWS = XLSX.utils.json_to_sheet(this.allfarmer)
      const wb = XLSX.utils.book_new()
      XLSX.utils.sheet_add_aoa(dataWS, Heading)
      XLSX.utils.book_append_sheet(wb, dataWS)
      XLSX.writeFile(wb, 'รายชื่อเกษตรกร.xlsx')
    },
    onExportadmin () {
      // console.log('log')
      const Heading = [['รหัสผู้ใช้งาน', 'ชื่อ', 'นามสกุล', 'อีเมล', 'ประเภทผู้ใช้งาน', 'วันเดือนปีเกิด', 'อายุ', 'อำเภอ', 'จังหวัด', 'วันที่สร้างบัญชี', 'วันที่แก้ไขบัญชี']]
      const dataWS = XLSX.utils.json_to_sheet(this.alladmin)
      const wb = XLSX.utils.book_new()
      XLSX.utils.sheet_add_aoa(dataWS, Heading)
      XLSX.utils.book_append_sheet(wb, dataWS)
      XLSX.writeFile(wb, 'รายชื่อแอดมิน.xlsx')
    },
    openinsertAdmin () {
      this.dialoginsertAdmin = true
    },
    insertAdmin () {
      if (this.$refs.formAdmin.validate()) {
        console.log('mmmm')
        axios
          .post('http://localhost/vue-backend/registerAdmin.php', {
            user_firstname: this.admin.user_firstname,
            user_lastname: this.admin.user_lastname,
            user_email: this.admin.user_email,
            user_password: this.admin.user_password,
            user_tel: this.admin.user_tel,
            user_type: this.admin.user_type,
            user_birthday: this.admin.user_birthday,
            user_district: this.admin.user_district,
            user_province: this.admin.user_province
          })
          .then(function (response) {
            console.log(response, 'ii')
            Swal.fire({
              icon: 'success',
              title: 'ลงทะเบียนสำเร็จ',
              showConfirmButton: false,
              // text: 'คำอธิบาย',
              customClass: {
                title: 'csss'
              },
              timer: 1500
            })
          })
        this.dialoginsertAdmin = false
        this.getReload()
          .catch(function (error) {
            console.log(error)
          })
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'กรุณากรอกข้อมูลให้ครบ',
          showConfirmButton: false,
          // text: 'คำอธิบาย',
          customClass: {
            title: 'csss'
          },
          timer: 1500
        })
      }
      this.dialoginsertAdmin = false
      this.getAdmin()
    }
  }

}

// mounted () {
//   this.getUser()
// }
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
