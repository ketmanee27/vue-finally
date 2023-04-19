<template>
  <div class="container">
    <NavbarUser />
    <div class="large-12 medium-12 small-12 cell">
      <label>
        <!-- <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/> -->
      </label>
      <button v-on:click="submitVideo()">Upload</button>
      <div
        class="imagePreviewWrapper"
        :style="{ 'background-image': `url(${previewImage})` }"
        @click="selectImage()"
      ></div>
      <input
        type="file"
        id="file"
        ref="file"
        v-on:change="onChangeFileUpload()"
        @input="pickFile"
      />
    </div>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        md="3"
        v-for="video in allvideo" v-bind:key="video.video_id"
      >
        <v-card class="mx-auto" max-width="400">
          <!-- <img src='lesson.lesson_unitimg'/> -->
          <iframe
          :src="video.video_file"></iframe>

          <!-- <video autoplay controls>
  <source src="video.video_file" />
</video> -->
          <!-- <video autoplay controls :src="video.video_file"></video> -->
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
      allvideo: [],
      video: {
        video_subunit: '',
        video_name: '',
        video_file: '',
        lesson_unit: ''
      },
      previewImage: null
    }
  },
  created () {
    this.getVideo()
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
        reader.onload = (e) => {
          this.previewImage = e.target.result
        }
        reader.readAsDataURL(file[0])
        this.$emit('input', file[0])
      }
    },
    async getVideo () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/video.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.allvideo = res.data
        }
      })
    },
    submitVideo () {
      const formData = new FormData()
      formData.append('file', this.file)

      this.axios
        .post('http://localhost/vue-backend/uploadVideo.php', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        })
        .then(function (data) {
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
