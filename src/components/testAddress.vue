<template>
<div id="app">
    <!-- ตำบล/แขวง -->
<addressinput-subdistrict class="addressinput" v-model="subdistrict" placeholder="ตำบล/แขวง"/>
<!-- อำเภอ/เขต -->
<addressinput-district class="addressinput" v-model="district" placeholder="อำเภอ/เขต"/>
<!-- จังหวัด -->
<addressinput-province class="addressinput" v-model="province" placeholder="จังหวัด"/>
<!-- รหัสไปรษณีย์ -->
<!-- <addressinput-zipcode v-model="zipcode" /> -->
<!-- <addressinput-subdistrict v-model="subdistrict" /> -->
<!-- <input type="text" v-model="subdistrict" />
<input type="text" v-model="district" />
<input type="text" v-model="province" /> -->

</div>

</template>

<script>

export default {
  data () {
    return {
      subdistrict: '',
      district: '',
      province: ''
      // zipcode: ''
    }
  }
  // methods: {
  //   onItemSelected ({ subdistrict, district, province, zipcode }) {
  //     subdistrict
  //   }
  // }
}
</script>

<style>
.addressinput{
  background-color: #000;
}
</style>
