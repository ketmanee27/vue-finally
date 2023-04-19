<template>
  <div class="app">
  <v-row >
    <v-col
    lg="5"
      sm="2"
      md="6"
      cols="6"

    >
      <div class="content">
        <img src="../assets/registerlogo.png" alt="img" class="image" />
            </div>
    </v-col>
    <v-col
      cols="12"
      sm="9"
      md="6"
      lg="7"
      class="mt-5"
        >
      <center>
      <v-title class="header" style="padding:20px">E-learning for Hens</v-title>
      <v-form ref="form" v-model="valid" lazy-validation action="register" class="sign-in-form ma-10" style="padding:0%">
        <h3 style="margin-bottom:25px"> <span class="linkLogin"  style="color:#aaa;"  onclick="window.location.href='/'">เข้าสู่ระบบ</span> <span class="border ml-3 mr-3"></span> <span class="linkRegister" style="color:#fcad74; font-size:25px;" onclick="window.location.href='Register'">ลงทะเบียน</span></h3>
      <v-row>
      <v-col
          cols="12"
          sm="4"
        >
       <v-text-field
      v-model="user.user_firstname"
      :rules="firstnameRules"
      :error-messages="nameErrors"
      label="ชื่อ"
      required
      filled
       rounded
       dense
       class="input1"
    ></v-text-field>
        </v-col>
     <v-col
          cols="12"
          sm="4"
        >
    <v-text-field
      v-model="user.user_lastname"
      :rules="lastnameRules"
      :error-messages="lastnameErrors"
      label="นามสกุล"
      required
      filled
       rounded
       dense
       class="input1"
    ></v-text-field>
     </v-col>
      <v-col
          cols="12"
          sm="4"
        >
    <v-text-field
      v-model="user.user_email"
      :rules="emailRules"
      :error-messages="emailErrors"
      label="อีเมล"
      filled
       rounded
       dense
       class="input1"
      required
    ></v-text-field>
      </v-col>
       <v-col
          cols="12"
          sm="4"
        >
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
       class="input1 input-group--focused"
      ></v-text-field>
       </v-col>
       <v-col
          cols="12"
          sm="4"
        >
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
        <!-- <v-col
          cols="12"
          sm="4"
        >
      <v-text-field
        type="text"
        v-model="user.user_tel"
        :rules="telRules"
        label="เบอร์โทร"
        filled
       rounded
       dense
       class="input1"
        required
      ></v-text-field>
        </v-col> -->
     <v-col
          cols="12"
          sm="4"
        >
      <!-- <v-text-field
        type="number"
        v-model="user.user_age"
        :rules="ageRules"
        label="อายุ"
        required
        min="1"
        max="100"
        filled
       rounded
       dense
       class="input1"
      ></v-text-field> -->
      <v-menu
        v-model="menu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="user.user_birthday"
            label="วันเดือนปีเกิด"
            :rules="birthdayRules"
            prepend-inner-icon="mdi-calendar-range"
            required
        filled
       rounded
       dense
            v-bind="attrs"
            v-on="on"
          ></v-text-field>
        </template>
        <v-date-picker v-model="user.user_birthday" locale="th" @input="menu = false"></v-date-picker>
      </v-menu>
     </v-col>
     <v-col
          cols="12"
          sm="4"
        >
    <v-select
          v-model="user.user_type"
        :items="['นักศึกษา', 'เกษตรกร']"
        :rules="rules.select"
        label="กลุ่มผู้ใช้งาน"
      :error-messages="selectErrors"
      required
      filled
       rounded
       dense
       class="input1"
      @change="$v.select.$touch()"
      @blur="$v.select.$touch()"
    >
        <template v-slot:item="{ item, attrs, on }">
        <v-list-item
            v-bind="attrs"
            v-on="on"
        >
            <v-list-item-title
            :id="attrs['aria-labelledby']"
            v-text="item"
            ></v-list-item-title>
        </v-list-item>
        </template>
    </v-select>
     </v-col>
     <v-col
          cols="12"
          sm="4"
        >
       <v-text-field
      v-model="user.user_district"
      :rules="districtRules"
      :error-messages="districtErrors"
      label="อำเภอ"
      required
      filled
       rounded
       dense
       class="input1"
    ></v-text-field>
        </v-col>
     <v-col
          cols="12"
          sm="4"
        >
    <v-text-field
      v-model="user.user_province"
      :rules="provinceRules"
      :error-messages="provinceErrors"
      label="จังหวัด"
      required
      filled
       rounded
       dense
       class="input1"
    ></v-text-field>
     </v-col>
    <!-- <v-col
          cols="12"
          sm="4"
          class="ma-0"
        >
        <addressinput-district class="addressinput" v-model="user.user_district" placeholder="อำเภอ"/>

        </v-col>
        <v-col
          cols="12"
          sm="4"
        >
        <addressinput-province class="addressinput" v-model="user.user_province" placeholder="จังหวัด"/>
        </v-col> -->
      </v-row>
      <v-row>
      <v-checkbox
            v-model="ex4"
            label="ยอมรับข้อตกลงเงื่อนไขการใช้งานและนโยบายความเป็นส่วนตัวของ E-learning for Hens"
            color="primary"
            value="primary"
            hide-details
            required
          ></v-checkbox></v-row>
          <p>สามารถตรวจสอบเงื่อนไขและ<span>
          <a href="#" @click.prevent="openDialog">นโยบายความเป็นส่วนตัว</a>
        </span>
      </p>
      <v-dialog v-model="dialog" max-width="500">
        <v-card>
          <v-card-title class="headline">นโยบายความเป็นส่วนตัว</v-card-title>
          <v-card-text>
          เว็บแอปพลิเคชัน อีเลิร์นนิงการเลี้ยงไก่ไข่พื้นเมือง  ให้ความสำคัญกับการคุ้มครองข้อมูลส่วนบุคคลของคุณ โดยนโยบายความเป็นส่วนตัวฉบับนี้ได้อธิบายแนวปฏิบัติเกี่ยวกับการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคล รวมถึงสิทธิต่าง ๆ ของเจ้าของข้อมูลส่วนบุคคล ตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล <br>
<b> การเก็บรวบรวมข้อมูลส่วนบุคคล</b><br>
เราจะเก็บรวบรวมข้อมูลส่วนบุคคลที่ได้รับโดยตรงจากคุณผ่านช่องทาง ดังต่อไปนี้<br>
* การสมัครสมาชิก<br>
* อีเมล <br>
<b> ประเภทข้อมูลส่วนบุคคลที่เก็บรวบรวม</b><br>
ข้อมูลส่วนบุคคล เช่น ชื่อ นามสกุล อายุ วันเดือนปีเกิด อำเภอ จังหวัด เป็นต้น
ข้อมูลการติดต่อ เช่น อีเมล ที่อยู่ เป็นต้น
ข้อมูลบัญชี เช่น บัญชีผู้ใช้งาน เป็นต้น
ข้อมูลทางเทคนิค เช่น IP address, Cookie ID, ประวัติการใช้งานเว็บไซต์ (Activity Log) เป็นต้น
ข้อมูลอื่น ๆ เช่น ข้อมูลที่ถือว่าเป็นข้อมูลส่วนบุคคลตามกฎหมายคุ้มครองข้อมูลส่วนบุคคล
<br>
<b> ผู้เยาว์</b><br>
หากคุณมีอายุต่ำกว่า 20 ปีหรือมีข้อจำกัดความสามารถตามกฎหมาย เราอาจเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เราอาจจำเป็นต้องให้พ่อแม่หรือผู้ปกครองของคุณให้ความยินยอมหรือที่กฎหมายอนุญาตให้ทำได้ หากเราทราบว่ามีการเก็บรวบรวมข้อมูลส่วนบุคคลจากผู้เยาว์โดยไม่ได้รับความยินยอมจากพ่อแม่หรือผู้ปกครอง เราจะดำเนินการลบข้อมูลนั้นออกจากเซิร์ฟเวอร์ของเรา <br>
<b>วิธีการเก็บรักษาข้อมูลส่วนบุคคล</b><br>
เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณในรูปแบบเอกสารและรูปแบบอิเล็กทรอนิกส์
เราเก็บรักษาข้อมูลส่วนบุคคลของคุณ ดังต่อไปนี้<br>
* ผู้ให้บริการเซิร์ฟเวอร์ในประเทศไทย<br>
* ผู้ให้บริการเซิร์ฟเวอร์ในต่างประเทศ <br>
<b> การประมวลผลข้อมูลส่วนบุคคล</b><br>
เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณเพื่อวัตถุประสงค์ดังต่อไปนี้<br>
* เพื่อสร้างและจัดการบัญชีผู้ใช้งาน<br>
* เพื่อนำข้อมูลส่วนตัวใช้ในการสอบ<br>
* เพื่อรวบรวมข้อเสนอแนะ<br>
* เพื่อปฏิบัติตามข้อตกลงและเงื่อนไข (Terms and Conditions)<br>
* เพื่อปฏิบัติตามกฎหมายและกฎระเบียบของหน่วยงานราชการ <br>
<b> การเปิดเผยข้อมูลส่วนบุคคล</b><br>
เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณให้แก่ผู้อื่นภายใต้ความยินยอมของคุณหรือที่กฎหมายอนุญาตให้เปิดเผยได้ ดังต่อไปนี้
การบริหารจัดการภายในองค์กร
เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณภายในบริษัทเท่าที่จำเป็นเพื่อปรับปรุงและพัฒนาสินค้าหรือบริการของเรา เราอาจรวบรวมข้อมูลภายในสำหรับสินค้าหรือบริการต่าง ๆ ภายใต้นโยบายนี้เพื่อประโยชน์ของคุณและผู้อื่นมากขึ้น
ผู้ให้บริการ
เราอาจเปิดเผยข้อมูลส่วนบุคคลของคุณบางอย่างให้กับผู้ให้บริการของเราเท่าที่จำเป็นเพื่อดำเนินงานในด้านต่าง ๆ ทั้งนี้ ผู้ให้บริการมีนโยบายความเป็นส่วนตัวของตนเอง
การโอนข้อมูลส่วนบุคคลไปต่างประเทศ
เราอาจเปิดเผยหรือโอนข้อมูลส่วนบุคคลของคุณไปยังบุคคล องค์กร หรือเซิร์ฟเวอร์ (Server) ที่ตั้งอยู่ในต่างประเทศ โดยเราจะดำเนินการตามมาตรการต่าง ๆ เพื่อให้มั่นใจว่าการโอนข้อมูลส่วนบุคคลของคุณไปยังประเทศปลายทางนั้นมีมาตรฐานการคุ้มครองข้อมูลส่วนบุคคลอย่างเพียงพอ หรือกรณีอื่น ๆ ตามที่กฎหมายกำหนด <br>

<b> ระยะเวลาจัดเก็บข้อมูลส่วนบุคคล</b><br>
เราจะเก็บรักษาข้อมูลส่วนบุคคลของคุณไว้ตามระยะเวลาที่จำเป็นในระหว่างที่คุณเป็นลูกค้าหรือมีความสัมพันธ์อยู่กับเราหรือตลอดระยะเวลาที่จำเป็นเพื่อให้บรรลุวัตถุประสงค์ที่เกี่ยวข้องกับนโยบายฉบับนี้ ซึ่งอาจจำเป็นต้องเก็บรักษาไว้ต่อไปภายหลังจากนั้น หากมีกฎหมายกำหนดไว้ เราจะลบ ทำลาย หรือทำให้เป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้ เมื่อหมดความจำเป็นหรือสิ้นสุดระยะเวลาดังกล่าว
<br>
<b> สิทธิของเจ้าของข้อมูลส่วนบุคคล</b><br>
ภายใต้กฎหมายคุ้มครองข้อมูลส่วนบุคคล คุณมีสิทธิในการดำเนินการดังต่อไปนี้
สิทธิขอถอนความยินยอม (right to withdraw consent) หากคุณได้ให้ความยินยอม เราจะเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ ไม่ว่าจะเป็นความยินยอมที่คุณให้ไว้ก่อนวันที่กฎหมายคุ้มครองข้อมูลส่วนบุคคลใช้บังคับหรือหลังจากนั้น คุณมีสิทธิที่จะถอนความยินยอมเมื่อใดก็ได้ตลอดเวลา
สิทธิขอเข้าถึงข้อมูล (right to access) คุณมีสิทธิขอเข้าถึงข้อมูลส่วนบุคคลของคุณที่อยู่ในความรับผิดชอบของเราและขอให้เราทำสำเนาข้อมูลดังกล่าวให้แก่คุณ รวมถึงขอให้เราเปิดเผยว่าเราได้ข้อมูลส่วนบุคคลของคุณมาได้อย่างไร
สิทธิขอถ่ายโอนข้อมูล (right to data portability) คุณมีสิทธิขอรับข้อมูลส่วนบุคคลของคุณในกรณีที่เราได้จัดทำข้อมูลส่วนบุคคลนั้นอยู่ในรูปแบบให้สามารถอ่านหรือใช้งานได้ด้วยเครื่องมือหรืออุปกรณ์ที่ทำงานได้โดยอัตโนมัติและสามารถใช้หรือเปิดเผยข้อมูลส่วนบุคคลได้ด้วยวิธีการอัตโนมัติ รวมทั้งมีสิทธิขอให้เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นเมื่อสามารถทำได้ด้วยวิธีการอัตโนมัติ และมีสิทธิขอรับข้อมูลส่วนบุคคลที่เราส่งหรือโอนข้อมูลส่วนบุคคลในรูปแบบดังกล่าวไปยังผู้ควบคุมข้อมูลส่วนบุคคลอื่นโดยตรง เว้นแต่ไม่สามารถดำเนินการได้เพราะเหตุทางเทคนิค
สิทธิขอคัดค้าน (right to object) คุณมีสิทธิขอคัดค้านการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณในเวลาใดก็ได้ หากการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณที่ทำขึ้นเพื่อการดำเนินงานที่จำเป็นภายใต้ประโยชน์โดยชอบด้วยกฎหมายของเราหรือของบุคคลหรือนิติบุคคลอื่น โดยไม่เกินขอบเขตที่คุณสามารถคาดหมายได้อย่างสมเหตุสมผลหรือเพื่อดำเนินการตามภารกิจเพื่อสาธารณประโยชน์
สิทธิขอให้ลบหรือทำลายข้อมูล (right to erasure/destruction) คุณมีสิทธิขอลบหรือทำลายข้อมูลส่วนบุคคลของคุณหรือทำให้ข้อมูลส่วนบุคคลเป็นข้อมูลที่ไม่สามารถระบุตัวคุณได้ หากคุณเชื่อว่าข้อมูลส่วนบุคคลของคุณถูกเก็บรวบรวม ใช้ หรือเปิดเผยโดยไม่ชอบด้วยกฎหมายที่เกี่ยวข้องหรือเห็นว่าเราหมดความจำเป็นในการเก็บรักษาไว้ตามวัตถุประสงค์ที่เกี่ยวข้องในนโยบายฉบับนี้ หรือเมื่อคุณได้ใช้สิทธิขอถอนความยินยอมหรือใช้สิทธิขอคัดค้านตามที่แจ้งไว้ข้างต้นแล้ว
สิทธิขอให้ระงับการใช้ข้อมูล (right to restriction of processing) คุณมีสิทธิขอให้ระงับการใช้ข้อมูลส่วนบุคคลชั่วคราวในกรณีที่เราอยู่ระหว่างตรวจสอบตามคำร้องขอใช้สิทธิขอแก้ไขข้อมูลส่วนบุคคลหรือขอคัดค้านของคุณหรือกรณีอื่นใดที่เราหมดความจำเป็นและต้องลบหรือทำลายข้อมูลส่วนบุคคลของคุณตามกฎหมายที่เกี่ยวข้องแต่คุณขอให้เราระงับการใช้แทน
สิทธิขอให้แก้ไขข้อมูล (right to rectification) คุณมีสิทธิขอแก้ไขข้อมูลส่วนบุคคลของคุณให้ถูกต้อง เป็นปัจจุบัน สมบูรณ์ และไม่ก่อให้เกิดความเข้าใจผิด
สิทธิร้องเรียน (right to lodge a complaint) คุณมีสิทธิร้องเรียนต่อผู้มีอำนาจตามกฎหมายที่เกี่ยวข้อง หากคุณเชื่อว่าการเก็บรวบรวม ใช้ หรือเปิดเผยข้อมูลส่วนบุคคลของคุณ เป็นการกระทำในลักษณะที่ฝ่าฝืนหรือไม่ปฏิบัติตามกฎหมายที่เกี่ยวข้อง
คุณสามารถใช้สิทธิของคุณในฐานะเจ้าของข้อมูลส่วนบุคคลข้างต้นได้ โดยติดต่อมาที่เจ้าหน้าที่คุ้มครองข้อมูลส่วนบุคคลของเราตามรายละเอียดท้ายนโยบายนี้ เราจะแจ้งผลการดำเนินการภายในระยะเวลา 30 วัน นับแต่วันที่เราได้รับคำขอใช้สิทธิจากคุณ ตามแบบฟอร์มหรือวิธีการที่เรากำหนด ทั้งนี้ หากเราปฏิเสธคำขอเราจะแจ้งเหตุผลของการปฏิเสธให้คุณทราบผ่านช่องทางต่าง ๆ เช่น ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น <br>
<b> การโฆษณาและการตลาด</b><br>
เราอาจส่งข้อมูลหรือจดหมายข่าวไปยังอีเมลของคุณ โดยมีวัตถุประสงค์เพื่อเสนอสิ่งที่น่าสนกับคุณ หากคุณไม่ต้องการรับการติดต่อสื่อสารจากเราผ่านทางอีเมลอีกต่อไป คุณสามารถกด "ยกเลิกการติดต่อ" ในลิงก์อีเมลหรือติดต่อมายังอีเมลของเราได้ <br>

<b> เทคโนโลยีติดตามตัวบุคคล (Cookies)</b><br>
เพื่อเพิ่มประสบการณ์การใช้งานของคุณให้สมบูรณ์และมีประสิทธิภาพมากขึ้น เราใช้คุกกี้ (Cookies)หรือเทคโนโลยีที่คล้ายคลึงกัน เพื่อพัฒนาการเข้าถึงสินค้าหรือบริการ โฆษณาที่เหมาะสม และติดตามการใช้งานของคุณ เราใช้คุกกี้เพื่อระบุและติดตามผู้ใช้งานเว็บไซต์และการเข้าถึงเว็บไซต์ของเรา หากคุณไม่ต้องการให้มีคุกกี้ไว้ในคอมพิวเตอร์ของคุณ คุณสามารถตั้งค่าบราวเซอร์เพื่อปฏิเสธคุกกี้ก่อนที่จะใช้เว็บไซต์ของเราได้ <br>

<b> การรักษาความมั่งคงปลอดภัยของข้อมูลส่วนบุคคล</b><br>
เราจะรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคลของคุณไว้ตามหลักการ การรักษาความลับ (confidentiality) ความถูกต้องครบถ้วน (integrity) และสภาพพร้อมใช้งาน (availability) ทั้งนี้ เพื่อป้องกันการสูญหาย เข้าถึง ใช้ เปลี่ยนแปลง แก้ไข หรือเปิดเผย นอกจากนี้เราจะจัดให้มีมาตรการรักษาความมั่นคงปลอดภัยของข้อมูลส่วนบุคคล ซึ่งครอบคลุมถึงมาตรการป้องกันด้านการบริหารจัดการ (administrative safeguard) มาตรการป้องกันด้านเทคนิค (technical safeguard) และมาตรการป้องกันทางกายภาพ (physical safeguard) ในเรื่องการเข้าถึงหรือควบคุมการใช้งานข้อมูลส่วนบุคคล (access control) <br>

<b> การแจ้งเหตุละเมิดข้อมูลส่วนบุคคล</b><br>
ในกรณีที่มีเหตุละเมิดข้อมูลส่วนบุคคลของคุณเกิดขึ้น เราจะแจ้งให้สำนักงานคณะกรรมการคุ้มครองข้อมูลส่วนบุคคลทราบโดยไม่ชักช้าภายใน 72 ชั่วโมง นับแต่ทราบเหตุเท่าที่สามารถกระทำได้ ในกรณีที่การละเมิดมีความเสี่ยงสูงที่จะมีผลกระทบต่อสิทธิและเสรีภาพของคุณ เราจะแจ้งการละเมิดให้คุณทราบพร้อมกับแนวทางการเยียวยาโดยไม่ชักช้าผ่านช่องทางต่าง ๆ เช่น เว็บไซต์ ข้อความ (SMS) อีเมล โทรศัพท์ จดหมาย เป็นต้น <br>

<b>การแก้ไขเปลี่ยนแปลงนโยบายความเป็นส่วนตัว</b><br>
เราอาจแก้ไขเปลี่ยนแปลงนโยบายนี้เป็นครั้งคราว โดยคุณสามารถทราบข้อกำหนดและเงื่อนไขนโยบายที่มีการแก้ไขเปลี่ยนแปลงนี้ได้ผ่านทางเว็บไซต์ของเรา
นโยบายนี้แก้ไขล่าสุดและมีผลใช้บังคับตั้งแต่วันที่ 01 กุมภาพันธ์ 2566 <br>

<b> นโยบายความเป็นส่วนตัวของเว็บไซต์อื่น</b><br>
นโยบายความเป็นส่วนตัวฉบับนี้ใช้สำหรับการเสนอสินค้า บริการ และการใช้งานบนเว็บไซต์สำหรับนักศึกษามหาวิทยาลัยขอนแก่นและเกษตรกรเท่านั้น หากคุณเข้าชมเว็บไซต์อื่นแม้จะผ่านช่องทางเว็บไซต์ของเรา การคุ้มครองข้อมูลส่วนบุคคลต่าง ๆ จะเป็นไปตามนโยบายความเป็นส่วนตัวของเว็บไซต์นั้น ซึ่งเราไม่มีส่วนเกี่ยวข้อง

          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" text @click="dialog = false">
              ปิด
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    <v-row>
        <input type="button" class="button button1 btn mr-5" value="ลงทะเบียน" @click="resgisterUser()"/>
      </v-row>
          </v-form>
        </center>
          </v-col>
          </v-row>
  <!-- Youtube Link -->
</div>
</template>

<script>
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  data: () => {
    return {
      menu: false,
      subdistrict: '',
      district: '',
      province: '',
      zipcode: '',
      signUp: true,
      ex4: false,
      dialog: false,
      user: {
        user_firstname: '',
        user_lastname: '',
        user_email: '',
        user_password: '',
        user_confirmPassword: '',
        user_type: '',
        user_age: '',
        user_district: '',
        user_province: '',
        user_birthday: ''
      },
      valid: true,
      show: false,
      showConfirm: false,
      firstnameRules: [
        v => !!v || 'กรุณากรอกชื่อ'
      ],
      lastnameRules: [
        v => !!v || 'กรุณากรอกนามสกุล'
      ],
      emailRules: [
        v => !!v || 'กรุณากรอกอีเมล',
        v => /.+@.+\..+/.test(v) || 'กรุณาใส่กรอกอีเมลให้ถูกต้อง'
      ],
      // passwordRules: [v => !!v || 'Password is required'],
      confirmPasswordRules: [v => !!v || 'กรุณากรอกยืนยันรหัสผ่าน'],
      passwordRules: {
        required: value => !!value || 'กรุณากรอกรหัสผ่าน',
        min: v => v.length >= 8 || 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัวอักษร',
        emailMatch: () => ('The email and password you entered don\'t match')
      },
      telRules: [
        v => !!v || 'กรุณากรอกเบอร์โทร'
      ],
      ageRules: [
        v => !!v || 'กรุณากรอกอายุ'
      ],
      birthdayRules: [
        v => !!v || 'กรุณากรอกวันเดือนปีเกิด'
      ],
      rules: {
        select: [v => !!v || 'กรุณากรอกกลุ่มผู้ใช้งาน']
      },
      districtRules: [
        v => !!v || 'กรุณากรอกอำเภอ'
      ],
      provinceRules: [
        v => !!v || 'กรุณากรอกจังหวัด'
      ]
    }
  },
  computed: {
    passwordConfirmationRule () {
      return () =>
        this.user.user_password === this.user.user_confirmPassword || 'กรุณากรอกรหัสผ่านให้ตรงกัน'
    }
  },
  methods: {
    resgisterUser () {
    //   console.log(this.user)
      console.log(this.$refs.form.validate(), 'pp')
      if (this.$refs.form.validate()) {
        console.log('mmmm')
        axios
          .post('http://localhost/vue-backend/register.php', {
            user_firstname: this.user.user_firstname,
            user_lastname: this.user.user_lastname,
            user_email: this.user.user_email,
            user_password: this.user.user_password,
            user_type: this.user.user_type,
            user_birthday: this.user.user_birthday,
            user_district: this.user.user_district,
            user_province: this.user.user_province
          })
          .then(function (response) {
            console.log(response, 'ii')
            Swal.fire({
              icon: 'success',
              title: 'ลงทะเบียนสำเร็จ',
              showConfirmButton: false,
              // text: 'คำอธิบาย',
              customClass: {
                title: 'csss'
              },
              timer: 1500
            })
          })
        this.$router.push('/')
          .catch(function (error) {
            console.log(error)
          })
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'กรุณากรอกข้อมูลให้ครบ',
          showConfirmButton: false,
          // text: 'คำอธิบาย',
          customClass: {
            title: 'csss'
          },
          timer: 1500
        })
      }
    },
    openDialog () {
      this.dialog = true
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

#app{
    padding: 0px;
    margin: 0px;
}

@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap");

* {
  margin: 0;
  // padding: 0;
  box-sizing: border-box;
    font-family: 'Prompt', sans-serif !important;

}
body,
input {
//   font-family: "Poppins", sans-serif;
}
.reg{
    text-decoration: underline;
}
.input1 {
  width: 40vw;
  color: #04befe;
}
.container {
  position: relative;
  width: 100vw;
//   background-color: #fff;
  //min-height: 100vh;
  // overflow: hidden;
}
// .all{
//   margin:auto;
// }
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
  background-color: #f0f0f0;
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
.linkRegister:hover{
  color: #D1551B !important;
}

.linkLogin:hover{
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
.input1{
  margin: 0%;
}
.border{
  border-left: 2px solid #aaa;

}
</style>
