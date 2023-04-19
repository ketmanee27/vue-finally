<template>
  <div>
    <h1>Video</h1>
    <v-form v-model="valid">
        <v-file-input
        required
    label="File input"
    v-model="file"
  ></v-file-input>
  {{ filess }}
  <v-btn
      color="error"
      class="mr-4"
      @click="addFormData()"
    >
      Save
    </v-btn>
    </v-form>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    file: '',
    valid: false
  }),

  methods: {
    addFormData () {
      const formData = new FormData()
      formData.append('file', this.file)
      //   alert(this.file)
      var headers = {
        'Content-Type': 'application/json',
        'Access-Control-Allow-Origin': '*'
      }

      axios.post('http://localhost/vue-backend/testVideo.php', formData, headers)
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
    }
  }
}
</script>

<style>

</style>
