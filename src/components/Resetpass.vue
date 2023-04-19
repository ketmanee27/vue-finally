<template>
  <div>
    <v-container fluid pa-0>
      <div>
        <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
      </div>
      <v-card
        elevation="0"
        style="border-color:#099fae; border-width: 2px;  margin-left:auto; margin-right:auto; margin-top:2%;"
        rounded
        outlined
        height="80vh"
        class="d-flex align-center justify-center"
      >
        <v-row align="center" justify="center">
          <v-col cols="12" class="ma-auto d-flex align-center justify-center">
            <v-card-title>เปลี่ยนรหัสผ่าน</v-card-title>
          </v-col>
            <v-form
              ref="form"
              v-model="valid"
              lazy-validation
              action="resrtpass"
              class="sign-in-form"
            >
            <v-col cols="12" class="ma-auto d-flex align-center justify-center">
              <v-text-field
                v-model="user.user_password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[passwordRules.required, passwordRules.min]"
                :type="show ? 'text' : 'password'"
                name="input-10-2"
                label="รหัสผ่าน"
                @click:append="show = !show"
                required
                filled
                rounded
                dense
              ></v-text-field>
            </v-col>
            <v-col cols="12" class="ma-auto d-flex align-center justify-center">
              <v-text-field
                v-model="user.user_confirmPassword"
                :rules="confirmPasswordRules.concat(passwordConfirmationRule)"
                :append-icon="showConfirm ? 'mdi-eye' : 'mdi-eye-off'"
                :type="showConfirm ? 'text' : 'password'"
                label="ยืนยันรหัสผ่าน"
                required
                filled
                rounded
                dense
                @click:append="showConfirm = !showConfirm"
              ></v-text-field>
            </v-col>
              <v-btn block :disabled="!isActive" class="input2" color="#099fae">ยืนยัน</v-btn>
            </v-form>
        </v-row>
      </v-card>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    show: false,
    showConfirm: false,
    otp: '',
    length: 5,
    breadcrumbs: [
      {
        text: 'หน้าเข้าสู่ระบบ',
        disabled: false,
        href: '/'
      },
      {
        text: 'หน้าเปลี่ยนรหัสผ่าน',
        disabled: true,
        href: 'resetpass'
      }
    ],
    user: {
      user_password: '',
      user_confirmPassword: ''
    },
    confirmPasswordRules: [v => !!v || 'กรุณากรอกยืนยันรหัสผ่าน'],
    passwordRules: {
      required: value => !!value || 'กรุณากรอกรหัสผ่าน',
      min: v => v.length >= 8 || 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
      emailMatch: () => ('The email and password you entered don\'t match')
    }

  }),
  computed: {
    isActive () {
      return this.otp.length === this.length
    },
    passwordConfirmationRule () {
      return () =>
        this.user.user_password === this.user.user_confirmPassword || 'กรุณากรอกรหัสผ่านให้ตรงกัน'
    }
  }
}
</script>

  <style scoped>
.v-breadcrumbs >>> a {
  color: #fcad74;
}
.input1 {
  margin: 5%;
}
</style>
