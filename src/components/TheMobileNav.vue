<template>
  <section class="nav">
    <div class="nav-menu">
      <ul class="nav-menu-list">
        <li>
          <a href="post"><v-icon
      large
      color="pink darken-2"
    >
      mdi-home
    </v-icon></a></li>
        <li>
           <a href="lesson"><v-icon
      large
      color="pink darken-2"
    >
      mdi-book-open-variant
    </v-icon></a></li>
        <li > <a href="quiz"><v-icon
      large
      color="pink darken-2"
    >
      mdi-notebook-edit

     </v-icon></a></li>
        <li > <a href="video"><v-icon
      large
      color="pink darken-2"
    >
      mdi-video
    </v-icon></a></li>
         <li > <a href="#"><v-icon
      large
      color="pink darken-2"
    >
      mdi-clipboard-text-clock
    </v-icon></a></li>
      </ul>
    </div>
  </section>
</template>

<script>
export default {

}
</script>

<style lang="sass" scoped>
.nav
  background: #FDD470
  display: flex
  flex-direction: column
  justify-content: space-around
  align-items: center
  .nav-brand
    margin: 20px auto
  .nav-menu
    width: 100%

.nav-menu-list
  list-style: none
  padding: 0
  display: flex
  margin: 0
  color: #000
  li
    width: 50%
    text-align: center
    background: #FDD741
    padding: 10px 0
    cursor: pointer
    transition: background 300ms ease-in-out
    &:first-of-type
      border-bottom: 5px solid #245B38
    &:hover
      background: #56a062
v-icon
  color: #fff !important
a
  list-style: none
  text-decoration: none
</style>
