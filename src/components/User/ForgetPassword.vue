<template>
  <div>

    <v-container fluid pa-0>

            <!-- <v-row align="center" justify="center"
                style="height:70vh" dense>
                <v-col cols="12" lg="6" md="6" class="grey lighten-2 fill-height d-flex flex-column justify-center align-center">
                    <v-card flat tile >
                        <div class="ma-auto" style="max-width: 260px">
                        <v-otp-input
      v-model="otp"
      type="password"
      length="5"
      dark
    ></v-otp-input>
</div>
                    </v-card>
                </v-col>
            </v-row> -->
<div>
                  <v-breadcrumbs
        :items="breadcrumbs"
        large
      ></v-breadcrumbs>
    </div>
            <v-card elevation="0" style="border-color:#099fae; border-width: 2px;" rounded outlined height="80vh"  class="d-flex align-center justify-center">
              <iframe src="http://localhost/vue-backend/forgotpassword/" width="100%" height="100%"></iframe>
          </v-card>
        </v-container>
  </div>
</template>

<script>

export default {
  data: () => ({
    otp: '',
    length: 5,
    breadcrumbs: [
      {
        text: 'หน้าเข้าสู่ระบบ',
        disabled: false,
        href: '/'
      },
      {
        text: 'หน้ายืนยันรหัส',
        disabled: true,
        href: 'history'
      }
    ]
  }),
  computed: {
    isActive () {
      return this.otp.length === this.length
    }
  }
}
</script>

<style scoped>
.v-breadcrumbs >>> a {
    color: #fcad74;
}
</style>
