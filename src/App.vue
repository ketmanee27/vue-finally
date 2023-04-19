<template>
    <v-app class="view-container" :class="className" >
      <v-main>
      <router-view></router-view>
    </v-main>
    </v-app>
</template>

<script>
// import TheDesktopNav from '@/components/TheDesktopNav'
// import TheMobileNav from '@/components/TheMobileNav'

export default {
  components: {
    // TheDesktopNav,
    // TheMobileNav
  },
  data () {
    return {
      checkRegister: true,
      contentWidth: '79%',
      className: 'fullpage'
    }
  },
  methods: {
    testpage (even) {
      this.contentWidth = '90%'
      this.checkRegister = even
      this.className = !even ? 'fullpage' : 'halfpage'
      console.log(even)
    }
  }
}
</script>

<style lang="sass" scoped>
.fullpage
  width:100vw
  margin-left: 0px
  //margin-top: 15vw
.halfpage
  width:79vw
  // margin-left: 20vw
  //margin-top: 5vw
#mobile-nav
  display: none

@media screen and (max-width: 1096px)
  .view-container
    width: 100%
    margin-left: 0
  #desktop-nav
    display: none
  #mobile-nav
    display: flex
</style>
