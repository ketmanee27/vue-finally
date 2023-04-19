<template>
  <div class="child">
    <h4>Detail</h4>
    <div class="row">
      <div class="col-md-6">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>NAME</th>
              <th>USER NAME</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{ user.user_id }}...</td>
             <td>{{ user.user_firstname }}</td>
             <td>{{ user.user_lastname }}</td>
            </tr>
          </tbody>
        </table>
        <router-link class="btn btn-secondary" :to="{ name: 'home' }">Back</router-link>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios'

export default {
  props: {
    id: this.$route.params.id,
    user: {}
  },
  data () {
    return {
      user_id: this.$route.params.id,
      user_firstname: {}
    }
  },
  methods: {
    getUser () {
      axios.get('http://localhost/vue-backend/editUser/' + this.id)
        .then((res) => {
          if (res.data) {
            this.user = res.data
          }
        // .catch(error => console.log(error))
        })
    },
    created () {
      this.$http.get('http://localhost/vue-backend/editUser/' + this.id).then(function (data) {
        console.log(data)
        this.user = data.body
      }
      )
    }
  }
}
</script>
