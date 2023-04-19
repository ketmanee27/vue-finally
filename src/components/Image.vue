<template>
  <div>
    <div>
      <!-- {{ alllesson[0] }} -->
        <!-- <p>{{ lesson.lesson_id }} {{ lesson.lesson_name }}</p> -->
    <v-select
    v-for="lesson in alllesson" v-bind:key="lesson.lesson_id"
        :items="lesson.lesson_id"
          label="Standard"
          v-model="lesson.lesson_name"
        >
        <!-- <option v-for="lesson in alllesson" v-bind:key="lesson.lesson_id">
      {{ lesson.lesson_name }}
    </option> -->
        </v-select>
      </div>
    <v-form v-model="valid">
      <v-text-field
            v-model="unit"
            label="บทเรียน"
            required
          ></v-text-field>
        <v-text-field
            v-model="name"
            label="name"
            required
          ></v-text-field>
        <v-file-input
        required
    accept="image/*"
    label="File input"
    v-model="file"
  ></v-file-input>
  {{ filess }}
  <!-- <v-container>
            <v-file-input accept="image/*"
                label="Select files"
                multiple chips color="pink"
                v-model="filess"
                @change="addFiless"></v-file-input>
            <v-row>
                <v-col sm="4" v-for="(file,f) in filess" :key="f">
                    {{file.name}}
                    <img :ref="'file'" src="//placehold.it/400/99cc77" class="img-fluid" :title="'file' + f" width="50%"/>
                </v-col>
            </v-row>
        </v-container> -->
  <v-btn
      color="error"
      class="mr-4"
      @click="addFormData()"
    >
      Save
    </v-btn>
    </v-form>
    <v-container>
            <h2 class="font-weight-light pink--text">File upload multiple</h2>
            <v-file-input accept="image/*"
                label="Select files"
                multiple chips color="pink"
                v-model="files"
                @change="addFiles"></v-file-input>
            <v-row>
                <v-col sm="4" v-for="(file,f) in files" :key="f">
                    {{file.name}}
                    <img :ref="'file'" src="//placehold.it/400/99cc77" class="img-fluid" :title="'file' + f" width="50%"/>
                </v-col>
            </v-row>
        </v-container>
        <v-container>
            <h2 class="font-weight-light pink--text">File upload multiple</h2>
            <v-file-input accept="image/*"
                label="Select files"
                multiple chips color="pink"
                v-model="files"
                @change="addImage"></v-file-input>
            <v-row>
                <v-col sm="4" v-for="(file,f) in files" :key="f">
                    {{file.name}}
                    <img :ref="'file'" src="//placehold.it/400/99cc77" class="img-fluid" :title="'file' + f" width="50%"/>
                </v-col>
            </v-row>
        </v-container>
  </div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  data: () => ({
    items: ['Foo', 'Bar', 'Fizz', 'Buzz'],
    alllesson: [],
    file: '',
    valid: false,
    unit: '',
    name: '',
    files: [],
    filess: [],
    readers: [],
    lesson: {
      lesson_id: '',
      lesson_name: '',
      lesson_description: ''
    }
  }),
  created () {
    this.getLesson()
  },
  methods: {
    async getLesson () {
      axios.get('http://localhost/vue-backend/editLesson.php').then((res) => {
        console.log('lesson:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
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
    async liveServerUpload () {
      this.file = this.$refs.file.files[0]
      alert(this.file, 'จ้าาา')

      const formData = new FormData()
      formData.append('file', this.file)

      axios.post('http://localhost/vue-backend/do_upload_files.php', formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(function (response) {
          if (!response.data) {
            alert('Sorry File not uploaded.')
          } else {
            alert('Your Vuejs with PHP File uploaded successfully.')
          }
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    addFormData () {
      const formData = new FormData()
      formData.append('unit', this.unit)
      formData.append('name', this.name)
      formData.append('file', this.file)
      //   alert(this.file)
      var headers = {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*'
      }

      axios.post('http://localhost/vue-backend/do_upload_files.php', formData, headers)
        .then(function (response) {
          // handle success
          console.log(response)
          console.log('success')
        })
        .catch(function (response) {
          // handle error
          console.log(response)
          console.log('sorry')
        })
    },
    addFiles () {
      console.log('files', this.files)
      this.files.forEach((file, f) => {
        this.readers[f] = new FileReader()
        this.readers[f].onloadend = (e) => {
          const fileData = this.readers[f].result
          const imgRef = this.$refs.file[f]
          alert(imgRef.src)
          imgRef.src = fileData
          console.log(fileData)
          // send to server here...
        }

        this.readers[f].readAsDataURL(this.files[f])
      })
    }
  }
}
</script>

<style>

</style>
