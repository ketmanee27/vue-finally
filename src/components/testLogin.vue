<template>
  <div>
    <v-row >
        <v-col class="left" align="center" cols="12" sm="12" md="12" lg="6" xl="6">
            <h1>friend</h1>
            <img src="../assets/loginlogo.png" alt="img" class="image" width="80%"/>
        </v-col>
        <v-col class="right" align="center" cols="12" sm="12" md="12" lg="6" xl="6">
            <h1>friend</h1>
            <v-card
            outlined
            height="90%"
            style="border: 1px solid black;"
            >
            <v-title class="header" style="padding:20px">E-learning for Hens</v-title>
            <v-form>
                <v-title class="font-weight mb-7">เข้าสู่ระบบ</v-title>
                <v-text-field
                class="ml-5 mr-5"
                label="อีเมล"
                filled
                rounded
                dense
                ></v-text-field>
                <v-text-field
                class="ml-5 mr-5"
                label="รหัสผ่าน"
                filled
                rounded
                dense
                ></v-text-field>
            </v-form>
            </v-card>
        </v-col>
    </v-row>
  </div>
</template>

<script>
export default {

}
</script>

<style>
v-card{
    border-color: black !important;
}
</style>
