<template>
  <div class="app">
    <NavbarUser />
    <div>
      <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
    </div>
    <h1 class="mt-0 mb-7" align="center">กระทู้ของฉัน</h1>
    <v-card class="cardShowuser">
      <v-card-title>
        <!-- <v-icon class="mr-2" color="#fcad74">mdi-book-open-variant</v-icon> -->
        <!-- <v-card class="mx-auto ma-5" width="60%">
     <v-card-title> -->
        <v-row align="center" justify="space-around">
          <v-col cols="9" class="ma-0 col9">
            <center>
              <v-form v-model="valid" ref="form">
                <v-text-field
                  class="inputpost"
                  label="โพสต์ข้อความ"
                  color="#099fae"
                  filled
                  rounded
                  clearable
                  dense
                  @click="dialogPost()"
                ></v-text-field>
              </v-form>
            </center>
          </v-col>
          <v-col cols="3" class="ma-0">
            <!-- <div class="text-center"> -->
            <center>
              <v-btn
                :disabled="!post_detail"
                height="52px"
                width="100%"
                class="white--text"
                rounded
                color="#099fae"
                @click="writePost()"
                >โพสต์</v-btn
              >
            </center>
            <!-- </div> -->
          </v-col>
        </v-row>
        <!-- </v-card-title>
    </v-card> -->
      </v-card-title>
    </v-card>

    <v-card
      class="cardShowuser"
      v-for="(postuser, index) in allapprove"
      :key="postuser.post_id"
    >
      <!-- {{postuser}} -->
      <v-card-title>
        {{ postuser.user_firstname }} {{ postuser.user_lastname }}&nbsp;<span
          style="color: #21777f"
          >{{ postuser.post_detail }}</span
        >
      </v-card-title>
      <div align="center" justify="space-around">
        <v-img
        class="align-center ml-5"
        width="20%"
        :src="postuser.post_img"
        rounded
      >
      </v-img>
      </div>
      <v-card-subtitle
        >โพสต์เมื่อ วันที่ {{ postuser.create_at }} น.</v-card-subtitle
      >
      <v-card-actions>
        <v-spacer></v-spacer>

        <v-btn
          v-if="panel !== postuser.post_id"
          icon
          @click="showtest(index, postuser.post_id)"
        >
          <v-icon color="#099fae">mdi-comment</v-icon>
        </v-btn>
        <v-btn v-else icon @click="showtest2(index)">
          <v-icon color="#099fae">mdi-comment-outline</v-icon>
        </v-btn>
      </v-card-actions>

      <v-expand-transition>
        <div v-show="show === index">
          <v-container fluid>
            <v-form v-model="valid2" ref="form2">
              <div
                class="mx-auto ma-3"
                width="60%"
                v-for="comment in allcomment"
                v-bind:key="comment.comment_id"
              >
                <div v-if="comment.post_id === postuser.post_id">
                  <v-divider class="mb-2"></v-divider>
                  <div color="#099fae">
                    {{ comment.user_firstname }} {{ comment.user_lastname }}
                    <span style="color: gray"
                      >แสดงความคิดเห็นเมื่อ {{ comment.create_at }} น.</span
                    >
                  </div>
                  <div>{{ comment.comment_detail }}</div>
                  <!-- <v-divider class="mt-3"></v-divider> -->
                </div>
              </div>
              <v-textarea
                v-model="comment_detail"
                filled
                auto-grow
                label="แสดงความคิดเห็น"
                rows="2"
                color="#099fae"
                row-height="20"
                @keyup.enter="writeComment(postuser.post_id)"
              >
              </v-textarea>
              <div class="text-center">
                <v-btn
                  rounded
                  color="#099fae"
                  dark
                  @click="writeComment(postuser.post_id)"
                >
                  <!-- <v-icon aria-label="My Account" role="img" aria-hidden="false">
                  mdi-comment
                </v-icon> -->
                  แสดงความคิดเห็น
                </v-btn>
              </div>
            </v-form>
          </v-container>
        </div>
      </v-expand-transition>
    </v-card>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title class="justify-center align-center"
          ><v-spacer></v-spacer>สร้างกระทู้<v-spacer></v-spacer
          ><v-btn icon @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn></v-card-title
        >
        <v-divider></v-divider>
        <v-card-text>
          <v-container>
            <v-form v-model="valid" ref="form">
              <v-row>
                <v-col cols="12" class="ma-0 pb-0">
                  <v-textarea
                    v-model="post_detail"
                    label="โพสต์ข้อความ"
                    auto-grow
                    filled
                    rows="3"
                    row-height="50"
                    shaped
                    color="#099fae"
                    clearable
                    rounded
                    class="mt-7 rounded-b-xl rounded-t-xl"
                  ></v-textarea>
                </v-col>
                <v-col cols="12">
                  <v-card outlined>
                    <v-card-actions>
                      <!-- เพิ่มลงในกระทู้ของคุณ
              <v-spacer></v-spacer> -->
                      <v-file-input
                        required
                        accept="image/*"
                        color="#099fae"
                        class="mt-3"
                        prepend-icon="mdi-image"
                        v-model="post_img"
                        label="เพิ่มรูปภาพ"
                      ></v-file-input>
                      <!-- <v-btn
              icon
        color="primary"
        round
        depressed
        :loading="isSelecting"
        @click="onButtonClick"
      >
        <v-icon>
          mdi-image
        </v-icon>
      </v-btn>
      <input
        ref="uploader"
        class="d-none"
        type="file"
        accept="image/*"
        @change="onFileChanged"
      > -->
                    </v-card-actions>
                  </v-card>
                </v-col>
                <!--<v-btn
                :disabled="!post_detail"
                height="52px"
                width="100%"
                class="white--text"
                rounded
                color="#099fae"
                @click="writePost()"
                >โพสต์</v-btn
              > -->
              </v-row>
            </v-form>
          </v-container>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" class="ma-0 pb-0">
                <v-btn
                  width="100%"
                  :disabled="!post_detail"
                  class="white--text"
                  color="#099fae"
                  @click="addFormData()"
                >
                  โพสต์
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'
import NavbarUser from '@/components/NavbarUser'
export default {
  components: {
    NavbarUser
  },
  name: 'show',
  data: () => ({
    defaultButtonText: null,
    selectedFile: null,
    isSelecting: false,
    dialog: false,
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
    allapprove: [],
    allpost: [],
    allcomment: [],
    show: false,
    post_detail: '',
    post_img: '',
    post_id: '',
    post_status: '',
    post_statusWait: 'waiting',
    user_id: '',
    comment_detail: '',
    comment_id: '',
    postuser: {
      post_detail: '',
      create_at: ''
    },
    comment: {
      comment_detail: '',
      create_at: ''
    },
    valid: false,
    valid2: false,
    panel: '',
    breadcrumbs: [
      {
        text: 'หน้าแรก',
        disabled: false,
        href: 'home'
      },
      {
        text: 'กระทู้ของฉัน',
        disabled: true,
        href: 'home'
      }
    ]
    // postRules: [
    //   v => !!v || ''
    // ]
  }),
  computed: {
    buttonText () {
      return this.selectedFile
        ? this.selectedFile.name
        : this.defaultButtonText
    }
  },
  created () {
    this.getComment()
    this.getPost()
  },
  // mounted () {
  //   this.$emit('test', true)
  // },
  methods: {
    dialogPost () {
      this.dialog = true
    },
    onButtonClick () {
      this.isSelecting = true
      window.addEventListener(
        'focus',
        () => {
          this.isSelecting = false
        },
        { once: true }
      )

      this.$refs.uploader.click()
    },
    onFileChanged (e) {
      this.selectedFile = e.target.files[0]

      // do something
    },
    showtest (index, postid) {
      this.show = index
      this.panel = postid
      this.comment_detail = ''
    },
    showtest2 (index) {
      this.show = !index
      this.panel = ''
    },
    async getPost () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/postApprove.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allpost = res.data
          this.allapprove = res.data
          console.log(this.allpost, 'โพสต์จ้า')
        }
      })
    },
    async getComment () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/comment.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allcomment = res.data
          console.log(this.allcomment, 'Comment')
        }
      })
    },
    addFormData () {
      if (this.$refs.form.validate()) {
        const formData = new FormData()
        formData.append('post_detail', this.post_detail)
        formData.append('post_img', this.post_img)
        formData.append('post_status', this.post_statusWait)
        formData.append('user_id', this.user.user_id)
        //   alert(this.file)
        var headers = {
          'Content-Type': 'application/json',
          'Access-Control-Allow-Origin': '*'
        }

        var { data } = axios
          .post(
            'http://localhost/vue-backend/insertPost.php',
            formData,
            headers
          )
          .then(function (response) {
            // handle success
            console.log(response)
            console.log('success')
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
          })
          .catch(function (response) {
            // handle error
            console.log(response)
            console.log('sorry')
          })
      }
      this.dialog = false
      this.$refs.form.reset()
      this.getPost()
    },
    async writePost () {
      // console.log(this.$refs.form.validate(), 'pp')
      if (this.$refs.form.validate()) {
        // กรอกครบมั้ย
        var { data } = await axios.post(
          'http://localhost/vue-backend/insertPost.php',
          {
            // post_id: this.post_id,
            post_detail: this.post_detail,
            post_status: 'waiting',
            user_id: this.user.user_id
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
    },
    async writeComment (postid) {
      console.log(postid, 'post ja')
      console.log(this.$refs.form.validate(), 'pp')
      if (this.comment_detail !== '') {
        // กรอกครบมั้ย
        var { data } = await axios.post(
          'http://localhost/vue-backend/insertComment.php',
          {
            comment_detail: this.comment_detail,
            post_id: postid,
            user_id: this.user.user_id
          }
        )
        if (data === 'success') {
          Swal.fire({
            icon: 'success',
            title: 'คอมเมนต์สำเร็จ',
            showConfirmButton: false,
            // text: 'คำอธิบาย',
            customClass: {
              title: 'csss'
            },
            timer: 1500
          })
        }
        this.getComment()
        // this.postuser.post_detail = ''
        this.comment_detail = ''
      }
    }
  }
}
</script>

<style scoped>
* {
  font-family: "Prompt", sans-serif;
}
.btnpost {
  display: flex !important;
  justify-content: center !important;
  align-items: center !important;
  /* height: 50px !important; */
  /* border: 3px solid green !important; */
  text-align: center !important;
  padding: 0px 30px !important;
}
.col9 {
  height: 76px;
}
.inputpost {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  width: 100%;
}
.csss {
  /* color: black !important; */
  font-family: "Kanit";
  font-weight: 400;
}
.cardShowuser {
  margin-top: 2%;
}
.v-breadcrumbs >>> a {
  color: #fcad74;
}
/* .app{
  background-color: black;
} */
</style>
