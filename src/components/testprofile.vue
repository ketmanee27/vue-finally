<template>
  <div>
    <h1>Hello World</h1>
      <h1>{{user_email}}</h1>
    </div>
</template>

<script>
import axios from 'axios'
export default {
  data: () => ({
    user_email: ''
    // data: ''
  }),
  created () {
    this.checkLogin()
  },
  methods: {
    async getEmail () {
      console.log('rewload')
      axios.get('http://localhost/vue-backend/success.php').then((res) => {
        if (res.data) {
          console.log('data:', res.data)
          this.data = res.data
        }
      })
    },
    checkLogin () {
      var useremail = localStorage.get('user_email')
      if (!useremail) {
        this.$router.push('/')
      } else {
        this.user_email = useremail
      }
    }
  }
}
</script>

<style>

</style>
