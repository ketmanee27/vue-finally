<template>
    <div>
        <NavbarAdmin />
        <div>
            <v-breadcrumbs :items="breadcrumbs" large></v-breadcrumbs>
        </div>
        <!-- <div id="years">{{ years }}</div>
        <div>{{ years }}</div>
        <div v-for="(year, y) in yearsList" :key="y" :value="year" >่อ้าว{{year}}</div>
        <v-select v-model="selectedYear"  placeholder="234234">
        <option v-for="(year, y) in yearsList" :key="y" :value="year" >
          {{year}}
        </option>
      </v-select> -->
        <v-card class="cardShowuser mt-0">
            <v-card-title>
                <v-icon class="mr-2" color="#fcad74">mdi-format-list-numbered</v-icon>
                คะแนนนักศึกษา
                <v-btn class="ml-5 text-capitalize" color="#e5ffee" dark elevation="1" @click="onExportstudent()">
          <span style="color:#2a7e4a;"><v-icon left> mdi-microsoft-excel </v-icon>Export</span></v-btn>
                <v-spacer></v-spacer>
                <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="ค้นหา"
                dense
                color="#099fae"
                single-line
                    hide-details></v-text-field>
            </v-card-title>

            <v-card-title>
              <v-dialog
        ref="dialog"
        v-model="modal"
        :return-value.sync="date"
        persistent
        width="290px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="date"
            label="ปีการศึกษา"
            readonly
            color="#fcad74"
            v-bind="attrs"
            v-on="on"
            outlined
          ></v-text-field>
        </template>
        <v-date-picker v-model="date" type="month" scrollable color="#fcad74" locale="th">
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="modal = false">ยกเลิก</v-btn>
          <v-btn text color="primary" @click="$refs.dialog.save(date)">บันทึก</v-btn>
        </v-date-picker>
      </v-dialog>
                <!-- <v-select
                    required
                    :items="['2560', '2561', '2562', '2563', '2564', '2565']"
                    label="ปีการศึกษา"
                    color="#fcad74"
                    outlined
                  >
                  <option v-for="(year, y) in yearsList" :key="y" :value="year">
          {{year}}
        </option>
                  </v-select> -->
            </v-card-title>
            <!-- <v-card-title>friend</v-card-title> -->
            <v-data-table
            :footer-props="{itemsPerPageText: 'แถวต่อหน้า',pageText: '{0}-{1} จาก {2}'}"
            :items="alluser"
            :headers="headers"
            :items-per-page="5"
            no-data-text="ไม่พบข้อมูล"
        no-results-text="ไม่พบข้อมูลที่ค้นหา"
            :search="search">
                <template slot="data">
                    <td>{{ user_firstname }}</td>
                    <td>{{ user_lastname }}</td>
                </template>
                <template v-slot:item.score="{ item }">
                 <td @click="score(item)">19</td>
                </template>
            </v-data-table>
            <template v-slot:item.score="{ item }">
      <v-icon
        small
        @click="score(item)"
        color="#56a062"
      >
        10
      </v-icon>
    </template>
        </v-card>
    </div>
</template>

<script>
import axios from 'axios'
// import Swal from 'sweetalert2'
import NavbarAdmin from '@/components/NavbarAdmin'
export default {
  components: {
    NavbarAdmin
  },
  data () {
    return {
      // yearFoundedOptions: utils.generateArrayOfYears(),
      // year: generateArrayOfYears().toString(),
      date: new Date().toISOString().substr(0, 7),
      // year: new Date().getFullYear(),
      yearsList: {},
      selectedYear: null,
      menu: false,
      modal: false,
      dialog: false,
      dialog1: false,
      valid: false,
      alluser: [{
        user_firstname: '',
        user_lastname: ''
      }
      ],
      search: '',
      headers: [
        {
          text: 'ชื่อ',
          align: 'start',
          // sortable: false,
          value: 'user_firstname'
        },
        { text: 'นามสกุล', value: 'user_lastname' },
        // { text: 'เนื้อหาบทเรียน', value: 'lesson_description' },
        { text: 'บทที่1', value: 'score', sortable: false },
        { text: 'บทที่2', value: 'score', sortable: false },
        { text: 'บทที่3', value: 'score', sortable: false },
        { text: 'บทที่4', value: 'score', sortable: false }

      ],
      breadcrumbs: [
        {
          text: 'หน้าแรก',
          disabled: false,
          href: 'home'
        },
        {
          text: 'คะแนนสอบ',
          disabled: true,
          href: 'adminScore'
        }
      ]
    }
  },
  created () {
    this.getUser()
  },
  watch: {
    menu (val) {
      val && this.$nextTick(() => (this.$refs.picker.activePicker = 'YEAR'))
    }
  },
  mounted () {
    this.getYearsList()
    this.year()
  },
  methods: {
    generateArrayOfYears () {
      var max = new Date().getFullYear()
      var min = max - 9
      var years = []

      for (var i = max; i >= min; i--) {
        years.push(i)
      }
      return years
    },
    getYearsList () {
      const startYear = 1990
      const endYear = new Date().getFullYear()
      for (let i = endYear; i >= startYear; i--) {
        this.yearsList.value = [this.yearsList.value, i]
        console.log(this.yearsList.value, 'year')
      }
    },
    async getUser (value) {
      this.type = value
      axios.get('http://localhost/vue-backend/editStudent.php').then((res) => {
        console.log('data:', res.data)
        if (res.data) {
          this.alluser = res.data
        }
      })
    }
  }
}
</script>

<style scoped>
* {
    font-family: 'Prompt', sans-serif;
}

.cardShowuser {
    margin-top: 5%;
}

.head {
    background-color: red;
}

.example {
    display: flex;
    flex-direction: column;
}

.editor {
    width: 100%;
    height: 30rem;
    overflow: hidden;
}

.output {
    width: 100%;
    height: 20rem;
    margin: 0;
    border: 1px solid #ccc;
    overflow-y: auto;
    resize: vertical;
}

.code {
    padding: 1rem;
    height: 16rem;
}

.ql-snow {
    border-top: none;
    height: 24rem;
}

.v-breadcrumbs>>>a {
    color: #fcad74;
}
/* .v-text-field--outlined >>> fieldset {
  border-color: #fcad74;
} */
</style>
