<template>
  <section class="nav">
      <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      permanent
      height="100vw"
      color="#FDD470"
      size="20vw"
    >
      <div class="nav-menu">
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <v-img src="https://randomuser.me/api/portraits/men/85.jpg"></v-img>
        </v-list-item-avatar>

        <v-list-item-title>Friend</v-list-item-title>

        <v-btn
          icon
          @click.stop="mini = !mini"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
      </v-list-item>
       <v-divider></v-divider>

      <v-list dense @click="r()">
        <v-list-item
          v-for="item in items"
          :key="item.title"
          link
          router :to="item.route"
        >
          <v-list-item-icon class="icon">
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content class="title"
          >
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </div>
    </v-navigation-drawer>
  </section>
</template>

<script>
export default {
  data () {
    return {
      drawer: true,
      items: [
        { title: 'หน้าแรก', icon: 'mdi-home-city', route: '/post' },
        { title: 'บทเรียน', icon: 'mdi-book-open-variant', route: '/lesson' },
        { title: 'แบบทดสอบ', icon: 'mdi-notebook-edit', route: '/quiz' },
        { title: 'วิดีโอ', icon: 'mdi-video', route: '/video' },
        { title: 'ประวัติเข้าเรียน', icon: 'mdi-clipboard-text-clock', route: '' },
        { title: 'บัญชีผู้ใช้', icon: 'mdi-account', route: '/profile' }
      ],
      mini: true
    }
  }
}
</script>

<style lang="sass" scoped>
@import url('https://fonts.googleapis.com/css2?family=Prompt&display=swap')

.nav
  position: fixed
  display: flex
  flex-direction: column
  align-items: center

.nav-menu-list
  list-style: none
  padding: 0
  .nav-list-item
    // background: #FBF3A1
    padding: 10px 20px
    text-align: center
    border-radius: 25px
    font-size: 1.5em
    margin: 10px auto
    cursor: pointer

// .button
//     background: #FBF3A1
//     padding: 10px 20px
//     text-align: center
//     border-radius: 25px
//     bottom: 0px
//     position: fixed
//     font-size: 1.2em
//     background: #56a062
//     margin: 15px auto
//     color: #fff !important
.btnlogin
    // background: #56a062 !important
    // left: 10px
    bottom: 0px
    // margin-top: 20px
    position: fixed
    display: flex
    margin: 10px auto
    padding: 10px 37px !important
    color: #fff !important
    align-items: center
a
  list-style: none
  text-decoration: none
.title
 margin-left:15%
 font-size: 1.5em !important
 cursor: pointer
</style>
