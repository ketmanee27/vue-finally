<template>
  <div>
    <nav>
      <v-toolbar app height="90px" elevation="9" class="rounded-lg" color="#099fae">
        <v-btn @click="drawer = !drawer" class="ma-2" fab dark elevation="0" text icon color="#white">
          <v-icon>
            mdi-menu
          </v-icon>
        </v-btn>
        <v-toolbar-title color="#white">
          <span class="font-weight-light text" color="#white">E-learning </span>
          <span class="text">for </span>
          <span class="text"> Hens</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
      <v-navigation-drawer app v-model="drawer" color="#099fae">
        <div class="nav-menu">
          <v-list-item class="px-2">
            <v-list-item-avatar>
              <v-avatar color="#ffeee2" size="30">
          <span class="text-uppercase" style="color:#fcad74;">{{ user.user_firstname[0] }}{{ user.user_lastname[0] }}</span>
        </v-avatar>
            </v-list-item-avatar>

            <v-list-title class="text" style="font-size: 1.4em;">{{
              user.user_firstname }}</v-list-title>

          </v-list-item>
          <v-divider></v-divider>

          <v-list dense nav @click="r()">
            <v-list-item v-for="item in items" :key="item.title" link router :to="item.route" class="icon">
              <v-list-item-icon class="icon">
                <v-icon class="icon">{{ item.icon }}</v-icon>
              </v-list-item-icon>

              <v-list-item-content class="title">
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </div>
        <template v-slot:append>
        <div class="pa-2">
          <v-btn block color="#fff" class="teal--text" @click="logout()">
            ออกจากระบบ
          </v-btn>
        </div>
      </template>
      </v-navigation-drawer>
    </nav>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  data () {
    return {
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
      drawer: false,
      items: [
        { title: 'Dashboard', icon: 'mdi-view-dashboard', route: '/admindashboard' },
        { title: 'หน้าแรก', icon: 'mdi-home', route: '/adminhome' },
        { title: 'จัดการโพสต์', icon: 'mdi-post', route: '/adminpost' },
        { title: 'จัดการบทเรียน', icon: 'mdi-book-open-variant', route: '/adminlesson' },
        { title: 'จัดการแบบทดสอบ', icon: 'mdi-notebook-edit', route: '/adminquiz' },
        { title: 'คะเเนนนักศึกษา', icon: 'mdi-format-list-numbered', route: '/adminscore' },
        { title: 'จัดการวิดีโอ', icon: 'mdi-video', route: '/adminvideo' },
        { title: 'จัดการเว็บไซต์เกี่ยวข้อง', icon: 'mdi-link', route: 'adminwebsite' },
        { title: 'จัดการผู้ใช้', icon: 'mdi-account-group', route: '/adminuser' },
        { title: 'บัญชีผู้ใช้', icon: 'mdi-account', route: '/adminprofile' }
      ]
    }
  },
  methods: {
    logout () {
      axios.post('http://localhost/vue-backend/logout.php').then(response => {
        localStorage.removeItem('id')
        localStorage.removeItem('user_firstname')
        localStorage.removeItem('user_lastname')
        localStorage.removeItem('user_email')
        localStorage.removeItem('user_age')
        localStorage.removeItem('user_birthday')
        localStorage.removeItem('user_district')
        localStorage.removeItem('user_province')
        localStorage.removeItem('type')
        localStorage.removeItem('create_at')
      })
      this.$router.push('/')
    }
  }
}
</script>
<style lang="sass" scoped>
.title
 color: #AB4D4 !important
 cursor: pointer
.font
 padding: 10% 5% !important
.icon
  color: #fff !important
.img
 margin:30px auto
 font-size: 1.2em !important
.px-2
 background: #099fae
 color: #AB4D4 !important
.ma-2
  font-size: 0.8em !important
  width:100%
  background: #AB4D4 !important
.text
 color:#fff
.v-list-item__title
  font-size: 0.8em !important
</style>
