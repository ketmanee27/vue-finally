<template>
<div>
  <NavbarAdmin/>
  <div>
<v-breadcrumbs
  :items="breadcrumbs"
  large
></v-breadcrumbs>
</div>
  <v-card class="cardShowuser mt-0 ">
    <v-tabs background-color="transparent" color="#099fae" grow v-model="tab">
        <v-tab @click="getPostWaiting('waiting')"> โพสต์รอการอนุมัติ </v-tab>
        <v-tab @click="getPostApprove('approve')"> โพสต์อนุมัติสำเร็จ </v-tab>
        <v-tab @click="getPostAll('all')"> โพสต์ทั้งหมด </v-tab>

      </v-tabs>
    <v-card-title v-show="status === 'waiting'">
      <v-icon class="mr-2" color="#fcad74">mdi-post</v-icon>
     โพสต์
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
    <!-- <v-card-title>friend</v-card-title> -->
       <v-data-table
       :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
       :items="allpost"
       :headers="headers"
       :items-per-page="5"
       :search="search"
       v-show="status === 'waiting'"
       no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
       >
       <template slot="data" slot-scope="props" >
        <td>{{ user_firstname }}</td>
        <td>{{ props.data.comment_detail }}</td>
      </template>
      <template v-slot:item.check="{ item }">
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

    <v-card-title v-show="status === 'approve'">
      <v-icon class="mr-2" color="#fcad74">mdi-post</v-icon>
     โพสต์
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
    <!-- <v-card-title>friend</v-card-title> -->
    <v-data-table
    :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
       :items="allpost"
       :headers="headers"
       :items-per-page="5"
       :search="search"
       v-show="status === 'approve'"
       no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
       >       <template slot="data" slot-scope="props" >
        <td>{{ user_firstname }}</td>
        <td>{{ props.data.comment_detail }}</td>
      </template>
      <template v-slot:item.check="{ item }">
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

    <v-card-title v-show="status === 'all'">
      <v-icon class="mr-2" color="#fcad74">mdi-post</v-icon>
     โพสต์
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
    <!-- <v-card-title>friend</v-card-title> -->
    <v-data-table
    :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
       :items="allpost"
       :headers="headers"
       :items-per-page="5"
       :search="search"
       v-show="status === 'all'"
       no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
       >       <template slot="data" slot-scope="props" >
        <td>{{ user_firstname }}</td>
        <td>{{ props.data.comment_detail }}</td>
      </template>
      <template v-slot:item.check="{ item }">
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

    <v-dialog v-model="dialog" max-width="600px" persistent>
                      <v-card>
          <v-card-title> จัดการโพสต์ </v-card-title>
          <v-card-text>
            <v-container>
              <v-form v-model="valid" ref="form">
              <v-row>
                <!-- <v-col cols="12">
                  <v-text-field
                    label="บทที่"
                    required
                    v-model="post_id"
                  ></v-text-field>
                </v-col> -->
                <v-col cols="12">
                  <v-text-field
                    label="โพสต์"
                    required
                    disabled
                    v-model="post_detail"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" class="ma-0 pt-0 pb-0" v-if="status === 'waiting'">
                    <v-checkbox
                    v-model="post_status"
                    label="อนุมัติโพสต์"
                    value="approve"
                  ></v-checkbox>
                </v-col>
                <v-col cols="12" class="ma-0 pt-0 pb-0" v-if="status === 'approve'">
                    <v-checkbox
                    v-model="post_status"
                    label="อนุมัติโพสต์"
                    disabled
                    value="approve"
                  ></v-checkbox>
                </v-col>
              </v-row>
            </v-form>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">
              ปิด
            </v-btn>
            <v-btn color="blue darken-1" text @click="saveUpdate ()"> บันทึก </v-btn>
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

export default {
  components: {
    NavbarAdmin
  },
  data () {
    return {
      show3: false,
      password: 'Password',
      rules: {
        required: value => !!value || 'Required.',
        min: v => v.length >= 8 || 'Min 8 characters',
        emailMatch: () => ('The email and password you entered don\'t match')
      },
      dialog: false,
      allpost: [],
      allwaiting: [],
      allapprove: [],
      search: '',
      post_id: '',
      post_detail: '',
      post_status: '',
      postuser: {
        post_detail: ''
      },
      user: {
        user_id: ''
      },
      valid: false,
      headers: [
        // {
        //   text: 'ชื่อ',
        //   align: 'start',
        //   // sortable: false,
        //   value: 'user_firstname'
        // },
        { text: 'โพสต์', value: 'post_detail' },
        { text: 'จัดการโพสต์', value: 'check', sortable: false },
        { text: 'ลบ', value: 'delete', sortable: false }

      ],
      data: [],
      breadcrumbs: [
        {
          text: 'Dashboard',
          disabled: false,
          href: 'admindashboard'
        },
        {
          text: 'จัดการโพสต์',
          disabled: true,
          href: 'adminpost'
        }
      ]
    }
  },
  created () {
    this.status = 'waiting'
    // this.statusWaiting = 'waiting'
    // this.statusApprove = 'approve'
    this.getPostWaiting(this.status)
    // this.getReload(this.status)
    // this.getPostWaiting(this.statusWaiting)
    // this.getPostApprove(this.statusApprove)
  },
  methods: {
    async getPostAll (value) {
      this.status = value
      console.log('rewload')
      axios.get('http://localhost/vue-backend/post.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allpost = res.data
        }
      })
    },
    async getPostWaiting (value) {
      this.status = value
      axios.get('http://localhost/vue-backend/postWaiting.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allpost = res.data
          this.allwaiting = res.data
        }
      })
    },
    async getPostApprove (value) {
      this.status = value
      axios.get('http://localhost/vue-backend/postApprove.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allpost = res.data
          this.allapprove = res.data
          // this.allstudent = res.data
        }
      })
    },
    // updateStatus (data) {
    //   this.post_status = data.post_status
    // },
    editItem (data) {
      // console.log('item:', this.items)มันไม่มีค่า มันเอามาจากตัวแปรitems:{}ข้างบน มันว่าง
      // console.log('item:', data)คือฟังก์ชันedit(data)ข้างบนdataที่ส่งมา
      this.dialog = true
      this.post_id = data.post_id
      this.post_detail = data.post_detail
      this.post_status = data.post_status
      this.create_at = data.create_at
      // console.log('friend data item', data)
      // console.log(this.allshow)
    },
    async saveUpdate (status) {
      if (this.post_status !== null && this.$refs.form.validate()) { // กรอกครบมั้ย
        var bodyValue = {
          post_id: this.post_id,
          post_detail: this.post_detail,
          post_status: this.post_status,
          create_at: this.create_at
        }
        var { data } = await axios.put(
          'http://localhost/vue-backend/updateStatusPost.php',
          bodyValue
        )
        console.log(data, 'data here!')
        if (data === 'success') {
          this.dialog = false
          Swal.fire({
            icon: 'success',
            title: 'อนุมัติโพสต์สำเร็จ',
            showConfirmButton: false,
            // text: 'คำอธิบาย',
            customClass: {
              title: 'csss'
            },
            timer: 1500
          })
        }
        this.status = status
        this.getReload(this.status)
      }
    },
    async deleteItem (data) {
      // var idDel = parseInt(data.id)
      var { data: deletes } = await axios.post('http://localhost/vue-backend/deletePost.php', {
        post_id: data.post_id,
        delete_at: data.delete_at
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
        this.status = data
        this.getReload(this.status)
      }
    },
    getReload (status) {
      if (status === 'all') {
        this.getPostAll('all')
      } else if (status === 'wating') {
        this.getPostWaiting('wating')
      } else {
        this.getPostWaiting('approve')
      }
    }
  }
  // mounted () {
  //   this.getUser()
  // }
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
.v-breadcrumbs >>> a {
    color: #fcad74;
}

</style>
