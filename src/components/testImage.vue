<template>
  <div class="container">
    <NavbarUser/>
    <div class="large-12 medium-12 small-12 cell">
      <label>
        <!-- <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/> -->
      </label>
        <button v-on:click="submitForm()">Upload</button>
        <div class="imagePreviewWrapper" :style="{ 'background-image': `url(${previewImage})` }" @click="selectImage ()"> </div>
        <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()" @input="pickFile" >
    </div>
    <v-row>
<v-col cols="12"
                sm="6"
                md="3"
                v-for="lesson in alllesson" v-bind:key="lesson.lesson_id">
  <v-card
    class="mx-auto"
    max-width="400"
    >
<!-- <img src='lesson.lesson_unitimg'/> -->
    <v-img
      class="white--text align-end"
      height="200px"
      :src="lesson.lesson_unitimg"
      alt="img ja"
          >
      <v-card-title>บทที่ {{lesson.lesson_unit}} </v-card-title>
    </v-img>

    <!-- <v-card-subtitle class="pb-0">
      Number 10
    </v-card-subtitle> -->

    <v-card-text class="text--primary">
      <div>{{lesson.lesson_name}}</div>
    </v-card-text>

    <v-card-actions>
      <router-link v-bind:to="'/lessondetail/'+ lesson.lesson_id">
      <v-btn
        color="#fcad74"
        text
      >
      อ่านเพิ่มเติม
      </v-btn>
    </router-link>

    </v-card-actions>
  </v-card>
</v-col>

  </v-row>
  </div>
</template>

<script>
import axios from 'axios'
import NavbarUser from '@/components/NavbarUser'

export default {
  components: {
    NavbarUser
  },
  data () {
    return {
      file: '',
      alllesson: [],
      lesson: {
        lesson_unit: '',
        lesson_name: '',
        lesson_unitimg: ''
      },
      previewImage: null
    }
  },
  created () {
    this.getLesson()
  },
  methods: {
    selectImage () {
      this.$refs.file.click()
    },
    pickFile () {
      const input = this.$refs.file
      const file = input.files
      if (file && file[0]) {
        const reader = new FileReader()
        reader.onload = e => {
          this.previewImage = e.target.result
        }
        reader.readAsDataURL(file[0])
        this.$emit('input', file[0])
      }
    },
    async getLesson () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/lesson.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alllesson = res.data
        }
      })
    },
    submitForm () {
      const formData = new FormData()
      formData.append('file', this.file)

      this.axios.post('http://localhost/vue-backend/upload.php',
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      ).then(function (data) {
        console.log(data.data)
      })
        .catch(function () {
          console.log('FAILURE!!')
        })
    },

    onChangeFileUpload () {
      this.file = this.$refs.file.files[0]
    }
  }
}
</script>

<style scoped>
.imagePreviewWrapper {
    width: 250px;
    height: 250px;
    display: block;
    cursor: pointer;
    margin: 0 auto 30px;
    background-size: cover;
    background-position: center center;
}
</style>
