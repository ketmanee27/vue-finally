<template>
  <div class="app">
  <v-row >
    <v-col
    lg="5"
      sm="3"
      md="6"
      cols="6"

    >
      <div class="content">
        <img src="../assets/loginlogo.png" alt="img" class="image" />
            </div>
    </v-col>
    <v-col
    cols="12"
      sm="9"
      md="6"
      lg="7"
      class="mt-15"
    >
    <center> <v-title class="header" style="padding:20px">E-learning for Hens</v-title></center>
            <v-form ref="form" v-model="valid" lazy-validation action="register" class="sign-in-form">
              <h3 style="margin-bottom:25px"> <span class="linkLogin" style="color:#fcad74; font-size:25px;" onclick="window.location.href='/'">เข้าสู่ระบบ</span> <span class="border ml-3 mr-3"></span> <span class="linkRegister" style="color:#aaa;" onclick="window.location.href='Register'">ลงทะเบียน</span></h3>
              <v-text-field
                v-model="user.user_email"
                :error-messages="emailErrors"
                :rules="emailRules"
                label="อีเมล"
                filled
                rounded
                dense
                class="input1"
                required
                @input="$v.email.$touch()"
                @blur="$v.email.$touch()"
              ></v-text-field>
              <v-text-field
                :type="show ? 'text' : 'password'"
                v-model="user.user_password"
                :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
                :rules="[passwordRules.required, passwordRules.min]"
                @click:append="show = !show"
                label="รหัสผ่าน"
                required
                filled
                rounded
                dense
                class="input1"
                @keyup.enter = "Login"
              ></v-text-field>
              <v-row >
              <input type="button" class="button button1 btn solid" value="เข้าสู่ระบบ" @click="Login"/>
              <!-- <input type="button"  class="button button3 btn1 solid ml-5" value="ลงทะเบียน" onclick="window.location.href='Register'"/> -->
            </v-row>
            <v-row>
              <div>
              <span class="text-red-lighten-1" onclick="window.location.href='forgetpassword'">ลืมรหัสผ่าน</span>
            </div>
              </v-row>
            </v-form>
    </v-col>
  </v-row>
</div>
</template>

<script>
import axios from 'axios'

export default {
  data: () => {
    return {
      signUp: false,
      user: {
        user_email: '',
        user_password: ''
      },
      show: false,
      emailRules: [
        // v => !!v || 'กรุณากรอกอีเมล',
        // v => /.+@.+\..+/.test(v) || 'กรุณาใส่กรอกอีเมลให้ถูกต้อง'
      ],
      passwordRules: {
        // required: value => !!value || 'กรุณากรอกรหัสผ่าน',
        // emailMatch: () => ('The email and password you entered don\'t match')
      },
      data: {}
    }
  },
  methods: {
    Login () {
      const test = this
      if (test.user.user_email !== '' && test.user.user_password !== '') {
        axios.post('http://localhost/vue-backend/login.php', {
          request: 1,
          user_email: test.user.user_email,
          user_password: test.user.user_password
        })
          .then(function (response) {
            test.data = response.data[0]

            console.log(test.data, 'friend')
            // alert(test.data.firstname)
            if (test.data.status === 1) {
              localStorage.setItem('id', test.data.id)
              localStorage.setItem('type', test.data.type)
              localStorage.setItem('user_firstname', test.data.user_firstname)
              localStorage.setItem('user_lastname', test.data.user_lastname)
              localStorage.setItem('user_email', test.data.user_email)
              localStorage.setItem('user_password', test.data.user_password)
              localStorage.setItem('user_birthday', test.data.user_birthday)
              localStorage.setItem('user_age', test.data.user_age)
              localStorage.setItem('user_district', test.data.user_district)
              localStorage.setItem('user_province', test.data.user_province)
              localStorage.setItem('create_at', test.data.create_at)

              console.log('id', test.data.id)

              //  localStorage.setItem('user_id', test.data.id)
              if (test.data.type === 'นักศึกษา') {
                // localStorage.setItem('email', this.user.user_email)
                test.$router.push('/home')
              } else if (test.data.type === 'เกษตรกร') {
                console.log('farmer')
                // console.log(test.$route, 'roter')
                test.$router.push('/home')
              } else {
                test.$router.push('/admindashboard')
              }
            } else {
              alert('ไม่มีผู้ใช้ กรุณาลงทะเบียน')
            }
          })
        test.$router.push('/register')
          .catch(function (error) {
            console.log(error)
          })
      } else {
        alert('กรุณากรอก อีเมล & รหัสผ่าน')
      }
    }
  }
}
</script>

<style lang="scss" scoped>
body {
  margin: 0;
  padding: 0;
  width: 100vw;
  height: 100vh;
  overflow: hidden;
}

// #app{
//     // padding: 0px;
//     margin: 0px;
//     padding: 10px 0px 0px 10px;
// }

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
    font-family: 'Prompt', sans-serif !important;

}
body,
input{
//   font-family: "Poppins", sans-serif;
}
.reg{
    text-decoration: underline;
}
.input1 {
  width: 100vw !important;
}
.container {
  position: relative;
  width: 100vw;
//   background-color: #fff;
  //min-height: 100vh;
  // overflow: hidden;
}
.all{
  margin:auto;
}
article{
    margin-top: -5vw;
}
// .forms-container {
//   position: absolute;
//   width: 100vw;
//   height: 100%;
//   top: 0;
//   left: 0;
// }

.signin-signup {
  position: absolute;
  top: 10%;
  transform: translate(-50%, -50%);
  // left: 85%;
  width: 70%;
  transition: 0.5s 0.5s ease-in-out;
  // display: grid;
  grid-template-columns: 1fr;
  z-index: 5;
}

form {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  padding: 5rem 5rem;
  transition: all 0.2s 0.2s;
  overflow: hidden;
  grid-column: 1 / 2;
  grid-row: 1 / 2;
}

form.sign-up-form {
  opacity: 0;
  z-index: 1;
}

form.sign-in-form {
  z-index: 2;
}

.title {
  font-size: 4.5rem;
  color: #444;
  margin-bottom: 20px;
//   font-family: "Poppins", sans-serif;
}

.input-field {
  max-width: 380px;
  width: 100%;
  // background-color: #f0f0f0;
  margin: 10px 0;
  height: 55px;
  border-radius: 55px;
  display: grid;
  grid-template-columns: 15% 85%;
  padding: 0 0.4rem;
  position: relative;
}

.input-field i {
  text-align: center;
  line-height: 55px;
  color: #acacac;
  transition: 0.5s;
  font-size: 1.1rem;
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: #333;
}

.input-field input::placeholder {
  color: #aaa;
  font-weight: 500;
}

.social-text {
  padding: 0.7rem 0;
  font-size: 1rem;
}

.social-media {
  display: flex;
  justify-content: center;
}

.social-icon {
  height: 46px;
  width: 46px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 0.45rem;
  color: #333;
  border-radius: 50%;
  border: 1px solid #333;
  text-decoration: none;
  font-size: 1.1rem;
  transition: 0.3s;
}

.social-icon:hover {
  color: #4481eb;
  border-color: #4481eb;
}

.btn {
  width: 150px;
  background-color: #5995fd;
  border: none;
  outline: none;
  height: 49px;
  border-radius: 49px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.5s;
}

.btn:hover {
  background-color: #2a68d5;
}
.btn1 {
  width: 150px;
  background-color: #fcad74;
  border: none;
  outline: none;
  height: 49px;
  border-radius: 49px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  margin: 10px 0;
  cursor: pointer;
  transition: 0.5s;
}

.btn1:hover {
  background-color: #D1551B;
}
.linkLogin:hover{
  color: #D1551B !important;
}

.linkRegister:hover{
  font-size: 25px;
  color: gray !important;
}

.image {
  width: 100%;
}

.btn.transparent {
  margin: 0;
  background: none;
  border: 2px solid #fff;
  width: 130px;
  height: 41px;
  font-weight: 600;
  font-size: 0.8rem;

}

/* ANIMATION */

.container.sign-up-mode:before {
  transform: translate(100%, -50%);
  right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
  transform: translateX(-800px);
}

.container.sign-up-mode .signin-signup {
  left: 25%;
}

.container.sign-up-mode form.sign-up-form {
  opacity: 1;
  z-index: 2;
}

.container.sign-up-mode form.sign-in-form {
  opacity: 0;
  z-index: 1;
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
  transform: translateX(0%);
}

@import url(https://fonts.googleapis.com/css?family=Righteous);
.header{
  // margin-bottom: 30px;
  font-size: 3em;
  font-weight: bold;
  font-family: 'Righteous', serif;
  background: linear-gradient(110deg, #fcad74 33%, rgba(253, 255, 144, 0) 33%), linear-gradient(110deg, #ffffff 34%, #4481eb 34%);
    background-size: 400%;
     -webkit-text-fill-color: transparent;
  background-size: 40%;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;

  animation: gradient 5s infinite;
}

@keyframes gradient {
  0% {
    background-position: 0% 50%;
  }
  100% {
    background-position: 100% 50%;
  }
}
.border{
  border-left: 2px solid #aaa;

}
</style>
