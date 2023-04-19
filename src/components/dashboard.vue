<template>
  <v-container>
    <v-item-group mandatory class="mt-n4">
      <v-toolbar color="rgba(0,0,0,0)" flat>
        <v-toolbar-title>ภาพรวมระบบ</v-toolbar-title>
      </v-toolbar>
      <v-row justify="center" class="space">
        <v-col cols="9" md="2">
          <v-item v-slot="{ active, toggle }">
            <v-dialog
              transition="dialog-bottom-transition"
              max-width="600"
            >
        <template v-slot:activator="{ on, attrs }">
            <v-card
              :color="active ? '#099fae' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="200"
              @click="toggle"
              v-bind="attrs"
              v-on="on"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <div class="mb-3">
                        <v-icon x-large :color="active ? 'white' : '#099fae'"
                          >mdi-account-school-outline</v-icon
                        >
                      </div>
                      <v-list-item-subtitle
                        :class="active ? 'white--text' : 'black--text'"
                        >นักศึกษา</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>{{allstudent.length}}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
            </template>
            <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="#099fae"
              dark
            >รายชื่อนักศึกษา</v-toolbar>
            <v-card-text>
              <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="ค้นหา"
        single-line
        hide-details
        color="#fcad74"
        class="mt-5"
      ></v-text-field>
    </v-card-title>
              <v-data-table
              :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="allstudent"
        :headers="headers"
        :items-per-page="5"
        :search="search"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="allstudent.length"
      >
      </v-data-table>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                color="primary"
                @click="dialog.value = false"
              >ปิด</v-btn>
            </v-card-actions>
          </v-card>
          </template>
      </v-dialog>
          </v-item>
        </v-col>
        <v-col cols="9" md="2">
          <v-item v-slot="{ active, toggle }">
            <v-dialog
              transition="dialog-bottom-transition"
              max-width="600"
            >
        <template v-slot:activator="{ on, attrs }">
            <v-card
              :color="active ? '#099fae' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="200"
              @click="toggle"
              v-bind="attrs"
              v-on="on"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <div class="mb-3">
                        <v-icon x-large :color="active ? 'white' : '#099fae'"
                          >mdi-account-cowboy-hat-outline</v-icon
                        >
                      </div>
                      <v-list-item-subtitle
                        :class="active ? 'white--text' : 'black--text'"
                        >เกษตรกร</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>{{allfarmer.length}}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
            </template>
            <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="#099fae"
              dark
            >รายชื่อเกษตรกร</v-toolbar>
            <v-card-text>
              <v-card-title>
      <v-text-field
        v-model="search2"
        append-icon="mdi-magnify"
        label="ค้นหา"
        single-line
        hide-details
        color="#fcad74"
        class="mt-5"
      ></v-text-field>
    </v-card-title>
              <v-data-table
              :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="allfarmer"
        :headers="headers"
        :items-per-page="5"
        :search="search2"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="allfarmer.length"
      >
      </v-data-table>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                color="primary"
                @click="dialog.value = false"
              >ปิด</v-btn>
            </v-card-actions>
          </v-card>
          </template>
      </v-dialog>
          </v-item>
        </v-col>
        <v-col cols="9" md="2">
          <v-item v-slot="{ active, toggle }">
            <v-dialog
              transition="dialog-bottom-transition"
              max-width="600"
            >
        <template v-slot:activator="{ on, attrs }">
            <v-card
              :color="active ? '#099fae' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="200"
              @click="toggle"
              v-bind="attrs"
              v-on="on"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <div class="mb-3">
                        <v-icon x-large :color="active ? 'white' : '#099fae'"
                          >mdi-clipboard-text-search-outline</v-icon
                        >
                      </div>
                      <v-list-item-subtitle
                        :class="active ? 'white--text' : 'black--text'"
                        >แอดมิน</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>{{alladmin.length}}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
            </template>
            <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="#099fae"
              dark
            >รายชื่อแอดมิน</v-toolbar>
            <v-card-text>
              <v-card-title>
      <v-text-field
        v-model="search3"
        append-icon="mdi-magnify"
        label="ค้นหา"
        single-line
        hide-details
        color="#fcad74"
        class="mt-5"
      ></v-text-field>
    </v-card-title>
              <v-data-table
              :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alladmin"
        :headers="headers"
        :items-per-page="5"
        :search="search3"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alladmin.length"
      >
      </v-data-table>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                color="primary"
                @click="dialog.value = false"
              >ปิด</v-btn>
            </v-card-actions>
          </v-card>
          </template>
      </v-dialog>
          </v-item>
        </v-col>
        <v-col cols="9" md="2">
          <v-item v-slot="{ active, toggle }">
            <v-dialog
              transition="dialog-bottom-transition"
              max-width="600"
            >
        <template v-slot:activator="{ on, attrs }">
            <v-card
              :color="active ? '#099fae' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="200"
              @click="toggle"
              v-bind="attrs"
              v-on="on"
            >
              <v-row>
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <div class="mb-3">
                        <v-icon x-large :color="active ? 'white' : '#099fae'"
                          >mdi-account-group-outline</v-icon
                        >
                      </div>
                      <v-list-item-subtitle
                        :class="active ? 'white--text' : 'black--text'"
                        >ผู้ใช้งานทั้งหมด</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>{{alluser.length}}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </v-row>
            </v-card>
            </template>
            <template v-slot:default="dialog">
          <v-card>
            <v-toolbar
              color="#099fae"
              dark
            >รายชื่อผู้ใช้งานทั้งหมด</v-toolbar>
            <v-card-text>
              <v-card-title>
      <v-text-field
        v-model="search4"
        append-icon="mdi-magnify"
        label="ค้นหา"
        single-line
        hide-details
        color="#fcad74"
        class="mt-5"
      ></v-text-field>
    </v-card-title>
              <v-data-table
              :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
        :items="alluser"
        :headers="headers"
        :items-per-page="5"
        :search="search4"
        no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
        v-if="alluser.length"
      >
      </v-data-table>
            </v-card-text>
            <v-card-actions class="justify-end">
              <v-btn
                text
                color="primary"
                @click="dialog.value = false"
              >ปิด</v-btn>
            </v-card-actions>
          </v-card>
          </template>
      </v-dialog>
          </v-item>
        </v-col>
        <v-col cols="9" md="2">
          <v-item v-slot="{ active, toggle }">
            <v-card
              :color="active ? '#099fae' : 'white'"
              class="d-flex align-center rounded-xl"
              dark
              height="200"
              @click="toggle"
            >
                  <v-row>
                    <a
                    href="adminpost"
                    class="text-decoration-none">
                <v-col cols="12" sm="12">
                  <v-list-item three-line class="mt-10">
                    <v-list-item-content>
                      <div class="mb-3">
                        <v-icon x-large :color="active ? 'white' : '#099fae'"
                          >mdi-post-outline</v-icon
                        >
                      </div>
                      <v-list-item-subtitle
                        :class="active ? 'white--text' : 'black--text' "
                        >โพสต์รอการอนุมัติ</v-list-item-subtitle
                      >
                      <v-list-item-title
                        class="headline mb-1"
                        :class="active ? 'white--text' : 'black--text'"
                      >
                        <strong>{{allwaiting.length}}</strong>
                      </v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-col>
              </a>
              </v-row>
            </v-card>
          </v-item>
        </v-col>
      </v-row>
    </v-item-group>
  </v-container>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      user_id: '',
      user_name: '',
      alluser: [],
      allstudent: [],
      allfarmer: [],
      alladmin: [],
      allwaiting: [],
      dialog: false,
      user: {
        user_id: '',
        user_firstname: '',
        user_lastname: ''
      },
      headers: [
        {
          text: 'ชื่อ',
          align: 'start',
          // sortable: false,
          value: 'user_firstname'
        },
        { text: 'นามสกุล', value: 'user_lastname' },
        { text: 'อีเมล', value: 'user_email' }
      ],
      search: '',
      search2: '',
      search3: '',
      search4: ''
    }
  },
  created () {
    this.getAllUser()
    this.getAllStudent()
    this.getAllFarmer()
    this.getAllAdmin()
    this.getPostWaiting()
  },
  methods: {
    async getAllUser () {
      axios.get('http://localhost/vue-backend/dashboardAlluser.php').then((res) => {
        console.log(res.data)
        if (res.data) {
          this.alluser = res.data
        }
      })
    },
    async getAllStudent () {
      axios.get('http://localhost/vue-backend/dashboardStudent.php').then((res) => {
        console.log(res.data)
        if (res.data) {
          this.allstudent = res.data
        }
      })
    },
    async getAllFarmer () {
      axios.get('http://localhost/vue-backend/dashboardFarmer.php').then((res) => {
        console.log(res.data)
        if (res.data) {
          this.allfarmer = res.data
        }
      })
    },
    async getAllAdmin () {
      axios.get('http://localhost/vue-backend/dashboardAdmin.php').then((res) => {
        console.log(res.data)
        if (res.data) {
          this.alladmin = res.data
        }
      })
    },
    async getPostWaiting () {
      axios.get('http://localhost/vue-backend/postWaiting.php').then((res) => {
        console.log('waiting:', res.data)
        if (res.data) {
          // this.allpost = res.data
          this.allwaiting = res.data
        }
      })
    }
  }
}
</script>

<style>
.mt-n5 {
  margin-top: 20px;
}
.v-list-item-content >>> .v-icon{
  text-decoration: none;
}
</style>
