<template>
      <div>
   <br />
   <h3 align="center">How to upload file using Vue.js with PHP</h3>
   <br />
   <div v-if="successAlert" class="alert alert-success alert-dismissible">
    <a href="#" class="close" aria-label="close" @click="successAlert=false">&times;</a>
    {{ successMessage }}
   </div>

   <div v-if="errorAlert" class="alert alert-danger alert-dismissible">
    <a href="#" class="close" aria-label="close" @click="errorAlert=false">&times;</a>
    {{ errorMessage }}
   </div>
   <div class="panel panel-default">
    <div class="panel-heading">
     <div class="row">
      <div class="col-md-6">
       <h3 class="panel-title">Upload File</h3>
      </div>
      <div class="col-md-6" align="right">
      </div>
     </div>
    </div>
    <div class="panel-body">
     <div class="row">
      <div class="col-md-4" align="right">
       <label>Select Image</label>
      </div>
      <div class="col-md-4">
       <input type="file" ref="file" />
      </div>
      <div class="col-md-4">
       <button type="button" @click="uploadImage" class="btn btn-primary">Upload Image</button>
      </div>
     </div>
     <br />
     <br />
     <div v-html="uploadedImage" align="center"></div>
    </div>
   </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      file: '',
      successAlert: false,
      errorAlert: false,
      uploadedImage: ''
    }
  },
  methods: {
    uploadImage () {
      this.file = this.$refs.file.files[0]

      var formData = new FormData()

      formData.append('file', this.file)

      axios.post('http://localhost/vue-backend/uploadImageLesson.php', formData, {
        header: {
          'Content-Type': 'multipart/form-data'
        }
      }).then(function (response) {
        if (response.data.image === '') {
          this.errorAlert = true
          this.successAlert = false
          this.errorMessage = response.data.message
          this.successMessage = ''
          this.uploadedImage = ''
        } else {
          this.errorAlert = false
          this.successAlert = true
          this.errorMessage = ''
          this.successMessage = response.data.message
          var imageName = "<img src='" + response.data.image + "' class='img-thumbnail' width='200' />"
          this.uploadedImage = imageName
          this.$refs.file.value = ''
        }
      })
    }
  }
}
</script>

<style>

</style>
